<?php

namespace App\Models;

use App\Enums\ContentStatus;
use App\Enums\ContentType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id',
    'type',
    'title',
    'slug',
    'headline',
    'excerpt',
    'body',
    'status',
    'hero_image',
    'reading_time_minutes',
    'published_at',
    'meta_title',
    'meta_description',
])]
class Content extends Model
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
            'type' => ContentType::class,
            'status' => ContentStatus::class,
            'reading_time_minutes' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Category that this content belongs to.
     *
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Intermediate pivot items connecting content to products.
     *
     * @return HasMany<ContentProduct, $this>
     */
    public function contentProducts(): HasMany
    {
        return $this->hasMany(ContentProduct::class)->orderBy('sort_order');
    }

    /**
     * Products curated within this guide or story.
     *
     * @return BelongsToMany<Product, $this>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'content_products')
            ->using(ContentProduct::class)
            ->withPivot(['id', 'tier', 'curation_reason', 'context_headline', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    /**
     * Scope a query to only include published contents.
     *
     * @param  Builder<Content>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', ContentStatus::Published)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include guides.
     *
     * @param  Builder<Content>  $query
     */
    public function scopeGuides(Builder $query): void
    {
        $query->where('type', ContentType::Guide);
    }

    /**
     * Scope a query to only include stories.
     *
     * @param  Builder<Content>  $query
     */
    public function scopeStories(Builder $query): void
    {
        $query->where('type', ContentType::Story);
    }

    /**
     * Scope a query to only include blog and research articles.
     *
     * @param  Builder<Content>  $query
     */
    public function scopeBlogs(Builder $query): void
    {
        $query->where('type', ContentType::Blog);
    }

    /**
     * Determine if this content is a decision or buying guide.
     */
    public function isGuide(): bool
    {
        return $this->type === ContentType::Guide;
    }

    /**
     * Determine if this content is a narrative story.
     */
    public function isStory(): bool
    {
        return $this->type === ContentType::Story;
    }

    /**
     * Determine if this content is a blog or research article.
     */
    public function isBlog(): bool
    {
        return $this->type === ContentType::Blog;
    }
}
