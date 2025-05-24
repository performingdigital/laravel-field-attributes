# laravel-field-attributes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/performing/laravel-field-attributes.svg?style=flat-square)](https://packagist.org/packages/performingdigital/laravel-field-attributes)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/performingdigital/laravel-field-attributes/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/performingdigital/laravel-field-attributes/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/performingdigital/laravel-field-attributes/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/performingdigital/laravel-field-attributes/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/performingd/laravel-field-attributes.svg?style=flat-square)](https://packagist.org/packages/performing/laravel-field-attributes)

Simple package to decorate classes with field attributes, allowing you to easily convert data objects to forms with labels and descriptions.

## Installation

You can install the package via composer:

```bash
composer require performing/laravel-field-attributes
```

## Usage

```php
class MyDto 
{
    use FieldAttributes;

    public function __construct(
        #[Field(label: 'Name', description: 'Enter your full name')]
        public string $name,
        #[Field(label: 'Email', description: 'Enter your email address')]
        public string $email,
    ) {}
}

$instance = new MyDto('John Doe', 'john@example.com');

$instance->getFieldValues(); 
// ['name' => 'John Doe', 'email' => 'john@example.com']

$instance->getFieldDefinitions(); 
// [
//    'name' => ['label' => 'Name', 'description' => 'Enter your full name', 'type' => 'string', 'required' => true, 'value' => 'John Doe'],
//    'email' => ['label' => 'Email', 'description' => 'Enter your email address', 'type' => 'string', 'required' => true, 'value' => 'john@example.com']
// ]
```

If you combine this with [spatie/laravel-data](https://github.com/spatie/laravel-data), you can also add validation on top, serialize and deserialize as JSON back and forth from the database.

In the package there is also a caster `ObjectCast` which can cast a json column to an object, it takes the class name from a `type` column of the eloquent model. You can also map types to specifc classes in the config.

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
