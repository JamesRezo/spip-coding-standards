# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/).

## [Unreleased]

## [1.3.3] - 2024-02-15

- replace `phpcsstandards/php_codesniffer` with `squizlabs/php_codesniffer` (#2)

## [1.3.2] - 2023-12-02

- replace `squizlabs/php_codesniffer` with `phpcsstandards/php_codesniffer` (#2)

## [1.3.0] - 2023-03-14

### Added

- `dev` keyword to prevent a "no-dev" installation (composer 2.4+)
- `SCS2` SPIP Coding Standard Ruleset
  - SCS1
  - prevention prefixed with an underscore on method names
  - Logical operator "and" & "or" are prohibited; use "&&"  & "||" instead
- `SPIP42` SPIP41 + SCS2
- `SPIP50` SCS2 + PHP8.1+ Compatibility Ruleset, including SCS2, for SPIP 4.2+

## [1.2.1] - 2021-08-25

### Changed

- Sniffs `SCS1.NamingConventions.SnakeCase*` trigger warnings instead of errors

## [1.2.0] - 2021-08-24

### Added

- `snake_case` Detection Utilies + Unit Tests
- Sniffs `SCS1.NamingConventions.SnakeCaseFunctionName` and `SCS1.NamingConventions.SnakeCaseVariableName` for SCS1
  - Taking account of special functions like `balise_*`
  - Class methods excluded

## [1.1.0] - 2021-08-21

### Added

- `SPIP41` PHP Compatibility Ruleset, including SCS1, for SPIP 4.1

### Changed

- `SCS1` Based on PSR-12 + short array syntax

## [1.0.0] - 2021-08-13

### Added

- `SCS1` SPIP Coding Standard Ruleset
- `SPIP40` PHP Compatibility Ruleset, including SCS1, for SPIP 4.0
