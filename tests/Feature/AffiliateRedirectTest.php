<?php

namespace Tests\Feature;

use App\Enums\AffiliatePlatform;
use App\Models\AffiliateOffer;
use App\Models\Category;
use App\Models\OutboundClick;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AffiliateRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_affiliate_offer_redirects_safely_and_logs_click(): void
    {
        $category = Category::create([
            'name' => 'Tech Tools',
            'slug' => 'tech-tools',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Mechanical Keyboard',
            'slug' => 'mechanical-keyboard',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $offer = AffiliateOffer::create([
            'product_id' => $product->id,
            'platform' => AffiliatePlatform::Amazon,
            'seller_name' => 'Official Store',
            'affiliate_url' => 'https://www.amazon.com/dp/example-product',
            'price' => 199,
            'is_primary' => true,
            'is_active' => true,
        ]);

        $response = $this->get(route('affiliate.out', $offer->id));

        $response->assertStatus(302);
        $response->assertRedirect('https://www.amazon.com/dp/example-product');

        $this->assertDatabaseHas('outbound_clicks', [
            'affiliate_offer_id' => $offer->id,
            'product_id' => $product->id,
            'platform' => AffiliatePlatform::Amazon->value,
        ]);
    }

    public function test_inactive_offer_redirects_back_to_product_with_warning(): void
    {
        $category = Category::create([
            'name' => 'Tech Tools',
            'slug' => 'tech-tools',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Screen Lightbar',
            'slug' => 'screen-lightbar',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $offer = AffiliateOffer::create([
            'product_id' => $product->id,
            'platform' => AffiliatePlatform::Shopee,
            'seller_name' => 'Discontinued Vendor',
            'affiliate_url' => 'https://shopee.co.id/example',
            'price' => 75,
            'is_primary' => false,
            'is_active' => false,
        ]);

        $response = $this->get(route('affiliate.out', $offer->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('showroom.product', ['slug' => 'screen-lightbar']));
        $this->assertEquals(0, OutboundClick::count());
    }
}
