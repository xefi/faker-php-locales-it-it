# Faker PHP — it_IT locale

Italian (`it_IT`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-it-it
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('it_IT');
```

Generators without a `it_IT` variant fall back to the default locale.

## Locale-specific generators

| Method | Extension | Example |
| --- | --- | --- |
| `province()` / `provinceCode()` | Address | `Milano` / `MI` |
| `codiceFiscale(?string $gender = null)` | Person | `RSSMRA85T10A562S` (valid check character) |
| `partitaIva()` | Company | `12345670017` (Luhn check digit) |
| `vat()` | Company | `IT12345670017` |
| `iban()` | Financial | `IT60X0542811101000000123456` (valid CIN) |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerItItServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
