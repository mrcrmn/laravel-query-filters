<?php

namespace Mrcrmn\QueryFilters\Tests;

class WhereTest extends TestCase
{
    public function test_it_has_some_products()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test');

        $res->assertJsonCount(4, 'data');
    }

    public function test_it_can_apply_the_where_filter_with_a_single_column()
    {
        $this->withoutExceptionHandling();

        $res = $this->json('GET', '__laravel_query_filters__/test?where=name,Product 1');

        $res->assertJsonCount(1, 'data');
        $res->assertJson(['data' => [
            [
                'name' => 'Product 1'
            ]
        ]]);
    }

    public function test_it_can_apply_the_where_filter_with_greater_than_operator()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,>=,15');

        $res->assertJsonCount(2, 'data');

        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,>,10');

        $res->assertJsonCount(2, 'data');
    }

    public function test_it_can_apply_the_where_filter_with_less_than_operator()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,<=,15');

        $res->assertJsonCount(3, 'data');

        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,<=,25');

        $res->assertJsonCount(4, 'data');
    }

    public function test_it_can_apply_multiple_wheres_in_a_single_query()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,<=,15:name,Product 1');

        $res->assertJsonCount(1, 'data');

        $res = $this->json('GET', '__laravel_query_filters__/test?where=in_stock,<=,3:name,Product 1');

        $res->assertJsonCount(0, 'data');
    }
}
