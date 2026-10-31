<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowroomCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully_with_curated_showroom(): void
    {
        $category = Category::create([
            'name' => 'Workspaces',
            'slug' => 'workspaces',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Ergonomic Desk',
            'slug' => 'ergonomic-desk',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Ergonomic Desk');
    }

    public function test_sitemap_xml_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $response->assertSee('urlset');
    }

    public function test_buying_guides_page_loads_successfully(): void
    {
        $response = $this->get('/guides');

        $response->assertStatus(200);
    }

    public function test_consumer_stories_page_loads_successfully(): void
    {
        $response = $this->get('/stories');

        $response->assertStatus(200);
    }
}
