<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_bookmarking(): void
    {
        $category = Category::create([
            'name' => 'Home Office',
            'slug' => 'home-office',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Ergonomic Chair',
            'slug' => 'ergonomic-chair',
            'is_active' => true,
        ]);

        $response = $this->post(route('bookmark.toggle', $product->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_member_can_toggle_bookmark(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Member,
        ]);

        $category = Category::create([
            'name' => 'Home Office',
            'slug' => 'home-office',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Ergonomic Chair',
            'slug' => 'ergonomic-chair',
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->post(route('bookmark.toggle', $product->id))
            ->assertStatus(302);

        $this->assertDatabaseHas('product_bookmarks', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        // Toggle again to remove
        $this->actingAs($user)
            ->post(route('bookmark.toggle', $product->id))
            ->assertStatus(302);

        $this->assertDatabaseMissing('product_bookmarks', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
