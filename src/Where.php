<?php

namespace Mrcrmn\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Where extends AbstractFilter
{
    protected function parse($whereQuery)
    {
        return explode(':', $whereQuery);
    }

    protected function apply($whereQuery)
    {
        $exploded = explode(',', $whereQuery);

        $column = $exploded[0];

        if (count($exploded) === 2) {
            $operator = '=';
            $value = $exploded[1];
        } else {
            $operator = $exploded[1];
            $value = $exploded[2];
        }

        return [$column, $operator, $value];
    }

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->request->has('where')) {
            $wheres = collect(
                $this->parse($this->request->query('where'))
            )->map(function ($where) {
                return $this->apply($where);
            })->toArray();

            $builder->where($wheres);
        }

        $next($builder);
    }
}
