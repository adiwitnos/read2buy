<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'category_id',
    'collection_id',
    'name',
    'slug',
    'brand',
    'tagline',
    'summary',
    'description',
    'specifications',
    'primary_image',
    'gallery_images',
    'estimated_price_min',
    'estimated_price_max',
    'is_featured',
    'is_active',
    'published_at',
])]
class Product extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'specifications' => 'array',
            'gallery_images' => 'array',
            'estimated_price_min' => 'integer',
            'estimated_price_max' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Category that this product belongs to.
     *
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Curated collection this product belongs to.
     *
     * @return BelongsTo<Collection, $this>
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * The Read2Buy Standard curation score and editorial evaluation.
     *
     * @return HasOne<CurationScore, $this>
     */
    public function curationScore(): HasOne
    {
        return $this->hasOne(CurationScore::class);
    }

    /**
     * Available affiliate offers from verified sellers.
     *
     * @return HasMany<AffiliateOffer, $this>
     */
    public function affiliateOffers(): HasMany
    {
        return $this->hasMany(AffiliateOffer::class);
    }

    /**
     * Primary affiliate offer to present first.
     *
     * @return HasOne<AffiliateOffer, $this>
     */
    public function primaryAffiliateOffer(): HasOne
    {
        return $this->hasOne(AffiliateOffer::class)
            ->where('is_active', true)
            ->orderByDesc('is_primary')
            ->orderBy('price');
    }

    /**
     * Alias for primaryAffiliateOffer.
     *
     * @return HasOne<AffiliateOffer, $this>
     */
    public function primaryOffer(): HasOne
    {
        return $this->primaryAffiliateOffer();
    }

    /**
     * Editorial deep-dive reviews for this product.
     *
     * @return HasMany<ProductReview, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * Research notes and online verification audits according to The Read2Buy Standard.
     *
     * @return HasMany<ResearchNote, $this>
     */
    public function researchNotes(): HasMany
    {
        return $this->hasMany(ResearchNote::class)->latest('reviewed_at');
    }

    /**
     * Primary / latest research note for this product.
     *
     * @return HasOne<ResearchNote, $this>
     */
    public function primaryResearchNote(): HasOne
    {
        return $this->hasOne(ResearchNote::class)->latestOfMany('reviewed_at');
    }

    /**
     * Contents (guides or stories) featuring this product.
     *
     * @return BelongsToMany<Content, $this>
     */
    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'content_products')
            ->withPivot(['id', 'tier', 'curation_reason', 'context_headline', 'sort_order'])
            ->withTimestamps();
    }

    /**
     * Intermediate pivot items connecting product to contents.
     *
     * @return HasMany<ContentProduct, $this>
     */
    public function contentProducts(): HasMany
    {
        return $this->hasMany(ContentProduct::class);
    }

    /**
     * Scope a query to only include active products.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published products.
     *
     * @param  Builder<Product>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include featured products.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /**
     * Bookmarks referencing this product.
     *
     * @return HasMany<ProductBookmark, $this>
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(ProductBookmark::class);
    }

    /**
     * Users who have bookmarked this product.
     *
     * @return BelongsToMany<User, $this>
     */
    public function bookmarkedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_bookmarks')
            ->withPivot(['id', 'notes'])
            ->withTimestamps();
    }
}
