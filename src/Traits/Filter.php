<?php

namespace Mrcrmn\QueryFilters\Traits;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Builder;

trait Filter
{
    /**
     * The eloquent scope which applies the query filters.
     *
     * @param Builder $builder The eloquent query builder instance.
     * @return void
     */
    public function scopeFilter(Builder $builder)
    {
        app(Pipeline::class)
            ->send($builder)
            ->through($this->getFilters())
            ->thenReturn();
    }
}
