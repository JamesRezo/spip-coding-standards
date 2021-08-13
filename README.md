# SPIP Standard Coding Rules for PHP_CodeSniffer

This is a set of rules for [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) that checks for SPIP Coding Standard and PHP Compatibility for SPIP v4.0.

## Installation

```bash
composer require --dev dealerdirect/phpcodesniffer-composer-installer spip/coding-standards
```

## Usage

```bash
vendor/bin/phpcs --standard=SCS1 /path/to/file
```

or create a `phpcs.xml` file containing this:

```xml
<?xml version="1.0"?>
<ruleset>
    <file>/path/to/file</file>
    <rule ref="SCS1" />
</ruleset>
```

and run :

```bash
vendor/bin/phpcs
```
