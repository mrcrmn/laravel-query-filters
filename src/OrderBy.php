<?php

namespace Mrcrmn\QueryFilters;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class OrderBy extends AbstractFilter
{
    protected function parse($orderByQuery)
    {
        if (Str::startsWith($orderByQuery, '-')) {
            $column = Str::substr($orderByQuery, 1);
            $direction = 'desc';
        } else {
            $column = $orderByQuery;
            $direction = 'asc';
        }

        return [$column, $direction];
    }

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->request->has('orderBy')) {
            [$column, $direction] = $this->parse($this->request->query('orderBy'));

            $builder->orderBy($column, $direction);
        }

        $next($builder);
    }
}
