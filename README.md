# PHP Wrapper for STEER Tracking Assessments API

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
$service = new SteerConnector($apiKey, $subscriptionKey, $baseUrl);
$service
  ->getAssessmentData(
    filters: [
      "house" => "Hufflepuff",
      "year" => 10
    ],
    year: 2019
  )
  ->object();
```

This will return an object with a `data` property which is an array of objects. Each object is the STEER tracking
assessment result.

The second argument in `getAssessmentData` (`year`) is optional and will default to the current academic year if not set. 

Filters available are: 
* `house` - filter by house name
* `campus` - filter by campus name
* `year` - filter by year group
* `mis_id` - filter by pupil's MIS ID
* `gender` - filter by gender (desired value is `m` or `f`)
* `round` - filter by round (as in the round of assessment)

With no filters set, the API will return all results for the current academic year.

See the [example output here](EXAMPLE.md).

This package uses the Saloon API package to make the HTTP requests. You can read more about that package [here](https://docs.saloon.dev/).

### Caching
By default the package will cache unique results (based on query) for 10 minutes. It uses the Local Filesystem cache driver from Saloon. You can read more about that [here](https://docs.saloon.dev/digging-deeper/caching-responses). 

### Testing

```bash
composer pest
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
