<?php

namespace App\Models\Concerns\Post;

use App\Support\Models\SearchName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasQueryScope
{
    use SearchName;

    /**
     * Scope a query to only include active posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include posts that are not active.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        return $query->when($request->filled('search'), function ($query) use ($request) {
            $query->searchName($request->search, 'title');
        });
    }
}
