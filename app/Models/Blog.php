<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static ofSlug(string $slug)
 * @method static active()
 */
class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $fillable = [
        "title",
        "slug",
        "description",
        "count_view",
        "status"
    ];

    /**
     * Scope a query get blog by slug
     *
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public function scopeOfSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * Scope a query get only active blogs
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status',1);
    }
}
