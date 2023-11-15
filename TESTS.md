# Running tests

## PHPStan

Go to DynamicDeviceDetectorCache plugin dir:

```bash
composer install
```

Go to Matomo root (/var/www/html usually) run:

```bash
/var/www/html/plugins/DynamicDeviceDetectorCache/vendor/bin/phpstan analyze -c /var/www/html/plugins/DynamicDeviceDetectorCache/tests/phpstan.neon --level=4 /var/www/html/plugins/DynamicDeviceDetectorCache
```

## PHPCS

Go to DynamicDeviceDetectorCache plugin dir:

```bash
composer install
```

Run PHP Codesniffer

```bash
vendor/bin/phpcs --ignore=*/vendor/*  --standard=PSR2 .
```
