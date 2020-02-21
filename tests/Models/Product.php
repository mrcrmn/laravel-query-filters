<?php

namespace Mrcrmn\QueryFilters\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Mrcrmn\QueryFilters\Contracts\Filterable;
use Mrcrmn\QueryFilters\Traits\Filter;

class Product extends Model implements Filterable
{
    use Filter;

    protected $table = 'test_products';

    protected $guarded = [];

    public function getFilters()
    {
        return [
            \Mrcrmn\QueryFilters\Where::class,
            \Mrcrmn\QueryFilters\OrderBy::class
        ];
    }
}
