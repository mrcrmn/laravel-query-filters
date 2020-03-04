<?php

namespace Mrcrmn\QueryFilters\Tests;

use Exception;

class OffsetTest extends TestCase
{
    public function test_it_can_be_offsetted()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test?orderBy=-in_stock');

        $res->assertJsonCount(4, 'data');

        $res->assertJson(['data' => [
            [ 'in_stock' => 20 ],
            [ 'in_stock' => 15 ],
            [ 'in_stock' => 10 ],
            [ 'in_stock' => 5 ],
        ]]);

        $res = $this->json('GET', '__laravel_query_filters__/test?orderBy=-in_stock&offset=2&limit=2');

        $res->assertJsonCount(2, 'data');

        $res->assertJson(['data' => [
            [ 'in_stock' => 10 ],
            [ 'in_stock' => 5 ],
        ]]);
    }

    public function test_offset_cant_be_used_without_limit()
    {
        $this->withoutExceptionHandling();
        $this->expectException(Exception::class);

        $this->json('GET', '__laravel_query_filters__/test?orderBy=-in_stock&offset=2');
    }
}
