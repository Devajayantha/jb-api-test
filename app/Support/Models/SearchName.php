<?php

namespace App\Support\Models;

use Illuminate\Contracts\Database\Query\Builder;

trait SearchName
{
    /**
     * Scope a query to only include search name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @param string $column
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchName(Builder $query, string $value, string $column = 'name'): Builder
    {
        return $query->where($column, 'like', "%$value%");
    }
}
