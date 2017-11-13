# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.3] - 2017-11-13
### Added

* `getFields()` now supports a `default` argument to address fields that can't be retrieved/return "falsey" values.

## [1.2] - ???
### Added

* You can now request unformated field data, either by passing a third bool false parameter to `getField` or by passing bool false with the key "format" as an argument for a field in `getFields`.
* `getField` and `getFields` are now a little bit more elegant, thanks to some small epiphanies.

## [1.1] - ???
### Changed

* Fixed: Using a callback without additional args (beyond the returned fields) caused an error.


## [1.0] - ???
### Added

* Implements basic functionality
* Current functionality is pulled directly from a previous implementation, and may need additional tweaking