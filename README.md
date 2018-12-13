# ACF 👩‍🔧

This provides a very, very simple wrapper for ACF. The only meaningful "feature" it adds in this version is the ability to query several fields at once, and return them in a compiled array.

## Usage

First, install the package:

```bash
composer require livy/plumbing-acf
```

Once it's installed, you can access its methods like so:

```php
Livy\Plumbing\ACF\Simple::getField('my-field');
// or
Livy\Plumbing\ACF\Function\field('my-field');

```

To save some typing, you can always use `use`:
```php
use Livy\Plumbing\ACF\Simple as ACF;
use function Livy\Plumbing\ACF\Function\field;

ACF::getField('my-field');
field('my-field');
```

### `fields()` / `getFields()`

This method can accept several fields to query at once, and will return them as an array (or a collection, if `Illuminate\Collection`) is available. See the method source for documentation.