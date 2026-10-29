<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'role', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Determine if user can access the given Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role' => UserRole::Member,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'role' => UserRole::class,
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user is an Administrator.
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Administrator;
    }

    /**
     * Determine if the user is a Member.
     */
    public function isMember(): bool
    {
        return $this->role === UserRole::Member;
    }

    /**
     * Affiliate product bookmark entries created by this user.
     *
     * @return HasMany<ProductBookmark, $this>
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(ProductBookmark::class);
    }

    /**
     * Products bookmarked by this user.
     *
     * @return BelongsToMany<Product, $this>
     */
    public function bookmarkedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_bookmarks')
            ->withPivot(['id', 'notes'])
            ->withTimestamps();
    }

    /**
     * Check if user has bookmarked the given product.
     */
    public function hasBookmarked(Product|int $product): bool
    {
        $productId = $product instanceof Product ? $product->id : $product;

        return $this->bookmarks()->where('product_id', $productId)->exists();
    }
}
