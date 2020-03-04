<?php

namespace Mrcrmn\QueryFilters;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class Offset extends AbstractFilter
{
    public function handle(Builder $builder, Closure $next)
    {
        if ($this->request->has('offset')) {
            if (! $this->request->has('limit')) {
                throw new Exception("In order to use 'offset', you also need to use 'limit'.");
            }

            $builder->offset($this->request->query('offset'));
        }

        $next($builder);
    }
}
