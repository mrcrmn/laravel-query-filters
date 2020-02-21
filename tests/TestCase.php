<?php

namespace Mrcrmn\QueryFilters\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Mrcrmn\QueryFilters\QueryFiltersServiceProvider;
use Mrcrmn\QueryFilters\Tests\Models\Product;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDb($this->app);
        $this->seedTestData();

        Route::get('__laravel_query_filters__/test', function () {
            return response()->json([
                'data' => Product::filter()->get()
            ]);
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            QueryFiltersServiceProvider::class
        ];
    }

    protected function setUpDb($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['db']->connection()->getSchemaBuilder()->create('test_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('in_stock')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
        });
    }

    protected function seedTestData()
    {
        Product::create([
            'name' => 'Product 1',
            'in_stock' => 5,
            'company' => 'TestCorp'
        ]);

        Product::create([
            'name' => 'Product 4',
            'in_stock' => 20,
            'company' => 'TestCorp'
        ]);

        Product::create([
            'name' => 'Product 2',
            'in_stock' => 10,
            'company' => 'TestCorp'
        ]);

        Product::create([
            'name' => 'Product 3',
            'in_stock' => 15,
            'company' => 'TestCorp'
        ]);
    }
}
