<?php

namespace Mrcrmn\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter
{
    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filter.
     *
     * @param Builder $builder The eloquent query builder object.
     * @param Closure $next The next filter closure to apply.
     * @return void
     */
    public abstract function handle(Builder $builder, Closure $next);
}
