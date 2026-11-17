<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Turnstile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TurnstileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.turnstile.secret' => '0x4AAAAAAGFxHEeR3GcETN6b0S0eww1OIYg']);
        config(['services.turnstile.key' => '0x4AAAAAAGFxHBbbfN4PTUnf']);
    }

    public function test_verify_returns_false_for_empty_or_oversized_tokens(): void
    {
        $this->assertFalse(Turnstile::verify(null));
        $this->assertFalse(Turnstile::verify(''));
        $this->assertFalse(Turnstile::verify(str_repeat('a', 2049)));
    }

    public function test_verify_returns_true_when_cloudflare_succeeds(): void
    {
        Turnstile::fake(true, 'login', 'read2buy.test');

        $result = Turnstile::verify('valid-token', 'login');

        $this->assertTrue($result);
    }

    public function test_verify_returns_false_when_cloudflare_fails(): void
    {
        Turnstile::fake(false);

        $result = Turnstile::verify('invalid-token', 'login');

        $this->assertFalse($result);
    }

    public function test_verify_returns_false_when_action_mismatches(): void
    {
        Turnstile::fake(true, 'register', 'read2buy.test');

        $result = Turnstile::verify('valid-token', 'login');

        $this->assertFalse($result);
    }

    public function test_verify_rejects_disallowed_hostname_when_configured(): void
    {
        config(['services.turnstile.hostnames' => 'example.com,read2buy.com']);

        Turnstile::fake(true, 'login', 'unauthorized.com');
        $this->assertFalse(Turnstile::verify('valid-token', 'login'));
    }

    public function test_verify_accepts_allowed_hostname_when_configured(): void
    {
        config(['services.turnstile.hostnames' => 'example.com,read2buy.com']);

        Turnstile::fake(true, 'login', 'read2buy.com');
        $this->assertTrue(Turnstile::verify('valid-token', 'login'));
    }

    public function test_login_requires_turnstile_response(): void
    {
        $user = User::factory()->create([
            'email' => 'member@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'member@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('cf-turnstile-response');
        $this->assertGuest();
    }

    public function test_login_succeeds_with_valid_turnstile_response(): void
    {
        Turnstile::fake(true, 'login');

        $user = User::factory()->create([
            'email' => 'member@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'member@example.com',
            'password' => 'password123',
            'cf-turnstile-response' => 'fake-valid-turnstile-token',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_registration_requires_turnstile_response(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'SecurePass123!',
            'password_confirmation' => 'SecurePass123!',
        ]);

        $response->assertSessionHasErrors('cf-turnstile-response');
        $this->assertDatabaseMissing('users', ['email' => 'john@example.com']);
    }

    public function test_registration_succeeds_with_valid_turnstile_response(): void
    {
        Turnstile::fake(true, 'register');

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'SecurePass123!',
            'password_confirmation' => 'SecurePass123!',
            'cf-turnstile-response' => 'fake-valid-turnstile-token',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $this->assertAuthenticated();
    }

    public function test_forgot_password_requires_turnstile_response(): void
    {
        $response = $this->post('/forgot-password', [
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('cf-turnstile-response');
    }

    public function test_auth_pages_render_turnstile_widget(): void
    {
        $loginRes = $this->get('/login');
        $loginRes->assertStatus(200);
        $loginRes->assertSee('cf-turnstile');
        $loginRes->assertSee('data-sitekey="0x4AAAAAAGFxHBbbfN4PTUnf"', false);
        $loginRes->assertSee('data-action="login"', false);
        $loginRes->assertSee('challenges.cloudflare.com/turnstile/v0/api.js', false);

        $registerRes = $this->get('/register');
        $registerRes->assertStatus(200);
        $registerRes->assertSee('cf-turnstile');
        $registerRes->assertSee('data-sitekey="0x4AAAAAAGFxHBbbfN4PTUnf"', false);
        $registerRes->assertSee('data-action="register"', false);
        $registerRes->assertSee('challenges.cloudflare.com/turnstile/v0/api.js', false);

        $forgotRes = $this->get('/forgot-password');
        $forgotRes->assertStatus(200);
        $forgotRes->assertSee('cf-turnstile');
        $forgotRes->assertSee('data-sitekey="0x4AAAAAAGFxHBbbfN4PTUnf"', false);
        $forgotRes->assertSee('data-action="forgot-password"', false);
        $forgotRes->assertSee('challenges.cloudflare.com/turnstile/v0/api.js', false);

        $resetRes = $this->get('/reset-password/sample-token?email=john@example.com');
        $resetRes->assertStatus(200);
        $resetRes->assertSee('cf-turnstile');
        $resetRes->assertSee('data-sitekey="0x4AAAAAAGFxHBbbfN4PTUnf"', false);
        $resetRes->assertSee('data-action="reset-password"', false);
        $resetRes->assertSee('challenges.cloudflare.com/turnstile/v0/api.js', false);
    }
}
