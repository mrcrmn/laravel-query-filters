# Laravel Query Filters

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrcrmn/laravel-query-filters.svg?style=flat-square)](https://packagist.org/packages/mrcrmn/laravel-query-filters)
[![Build Status](https://img.shields.io/travis/mrcrmn/laravel-query-filters/master.svg?style=flat-square)](https://travis-ci.org/mrcrmn/laravel-query-filters)
[![Quality Score](https://img.shields.io/scrutinizer/g/mrcrmn/laravel-query-filters.svg?style=flat-square)](https://scrutinizer-ci.com/g/mrcrmn/laravel-query-filters)
[![Total Downloads](https://img.shields.io/packagist/dt/mrcrmn/laravel-query-filters.svg?style=flat-square)](https://packagist.org/packages/mrcrmn/laravel-query-filters)

Automatically query your eloquent models based on the request's query parameters.

## Installation

You can install the package via composer:

```bash
composer require mrcrmn/laravel-query-filters
```

## Baseic Usage

A more detailed documentation is work in progress!

To use this package, simply set up your models like this:

``` php
use Mrcrmn\QueryFilters\Traits\Filter;
use Mrcrmn\QueryFilters\Contracts\Filterable;

class YourModel extends Model implements Filterable
{
    use Filter;

    public function getFilters()
    {
        return [
            \Mrcrmn\QueryFilters\Where::class,
            \Mrcrmn\QueryFilters\OrderBy::class,
            // ...
        ];
    }
}
```

Then in your controller you need to call the `filter` scope.

```php
class Controller
{
    public function index()
    {
        $result = YourModel::filter()->get();

        // ...
    }
}
```

So finally you can use your api like this:

```
https://your-domain.com/api/your-model?where=price,>100&orderBy=-created_at
```

### Testing

``` bash
composer test
```

### Security

If you discover any security related issues, please email marcoreimann@outlook.de instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
