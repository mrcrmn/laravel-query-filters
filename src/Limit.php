<?php

namespace Mrcrmn\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Limit extends AbstractFilter
{
    public function handle(Builder $builder, Closure $next)
    {
        if ($this->request->has('limit')) {
            $builder->limit($this->request->query('limit'));
        }

        $next($builder);
    }
}
