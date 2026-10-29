<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable([
    'key',
    'group',
    'value',
])]
class SiteSetting extends Model
{
    use HasFactory;

    /**
     * Get a setting value with optional fallback.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("site_setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting !== null ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value and update cache.
     */
    public static function set(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget("site_setting.{$key}");
    }
}
