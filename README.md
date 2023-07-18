# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fredbradley/php-steer-api.svg?style=flat-square)](https://packagist.org/packages/fredbradley/php-steer-api)
[![Total Downloads](https://img.shields.io/packagist/dt/fredbradley/php-steer-api.svg?style=flat-square)](https://packagist.org/packages/fredbradley/php-steer-api)
![GitHub Actions](https://github.com/fredbradley/php-steer-api/actions/workflows/main.yml/badge.svg)

STEER Education are in the process of developing an API to access the assessment results for pupils. I am helping them with this as we have already many of the building blocks in place with Cranleigh School's Pastoral Module. 

This package is a PHP wrapper to the STEER API. Any suggestions or improvements are welcome both in terms of data output and the fluency of interacting with the code.

## Installation

You can install the package via composer:

```bash
composer require fredbradley/php-steer-api
```

## Usage

```php
$service = new \FredBradley\PhpSteerApi\Client($apiKey, $subscriptionId, $baseUrl);
$queryBuilder = new \FredBradley\PhpSteerApi\QueryBuilder();
$query = $queryBuilder->filterHouse('Hufflepuff')->filterCampus('Hogwarts')->setYear(2020);
$service->get($query);
```

This will return an object with a `data` property which is an array of objects. Each object is the STEER tracking
assessment result.

`setYear()` is optional and will default to the current academic year if not set. 

Filters available are: 
* `filterHouse()` - filter by house name
* `filterCampus()` - filter by campus name
* `filterYear()` - filter by year group
* `filterMisId()` - filter by pupil's MIS ID
* `filterGender()` - filter by gender (desired value is `m` or `f`)
* `filterRound()` - filter by round (as in the round of assessment)

With no filters set, the API will return all results for the current academic year.

See the example output here: 

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email code@fredbradley.co.uk instead of using the issue tracker.

## Credits

- [Fred Bradley](https://github.com/fredbradley)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
