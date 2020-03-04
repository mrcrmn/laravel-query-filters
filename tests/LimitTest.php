<?php

namespace Mrcrmn\QueryFilters\Tests;

class LimitTest extends TestCase
{
    public function test_it_can_be_limited()
    {
        $res = $this->json('GET', '__laravel_query_filters__/test');

        $res->assertJsonCount(4, 'data');

        $res = $this->json('GET', '__laravel_query_filters__/test?limit=1');

        $res->assertJsonCount(1, 'data');

        $res = $this->json('GET', '__laravel_query_filters__/test?limit=2');

        $res->assertJsonCount(2, 'data');
    }
}
