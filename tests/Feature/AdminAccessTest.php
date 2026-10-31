<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_when_accessing_admin_panel(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function test_regular_member_cannot_access_admin_panel(): void
    {
        $member = User::factory()->create([
            'role' => UserRole::Member,
        ]);

        $response = $this->actingAs($member)->get('/admin');

        $response->assertStatus(403);
    }

    public function test_administrator_can_access_admin_panel(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::Administrator,
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }
}
