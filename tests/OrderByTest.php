<?php

namespace Mrcrmn\QueryFilters\Tests;

class OrderByTest extends TestCase
{
    public function test_it_can_be_ordered_in_descending_order()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?orderBy=-in_stock');

        $res->assertJsonCount(4, 'data');

        $res->assertJson(['data' => [
            ['in_stock' => 20],
            ['in_stock' => 15],
            ['in_stock' => 10],
            ['in_stock' => 5],
        ]]);
    }

    public function test_it_can_be_ordered_in_ascending_order()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?orderBy=in_stock');

        $res->assertJsonCount(4, 'data');

        $res->assertJson(['data' => [
            ['in_stock' => 5],
            ['in_stock' => 10],
            ['in_stock' => 15],
            ['in_stock' => 20],
        ]]);
    }
}
