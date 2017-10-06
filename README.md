# Drop-in Model References

[![Build Status](https://travis-ci.org/jameslkingsley/laravel-references.svg?branch=master)](https://travis-ci.org/jameslkingsley/laravel-references)

This Laravel >=5.5 package provides a quick and simple way to add unique references to models that can be resolved via route model binding. You usually don't want to expose your primary keys to the client, and without a unique reference such as a username or slug, you can't quickly build a RESTful API. With this package you can give your models a unique reference and instantly start using it in your routes.

Here are a few short examples of what you can do:

```php
// Simply add the binding to your route
Route::get('/api/customers/{ref}', function (Customer $customer) {
    //
});

// Then just use the model's reference in your request
GET /api/customers/cus_tKCulsB67hty
```

## Installation

You can install this package via composer using this command:

```bash
composer require jameslkingsley/laravel-references
```

**If you're using Laravel 5.5 or greater this package will be auto-discovered, however if you're using anything lower than 5.5 you will need to register it the old way:**

Next, you must install the service provider in `config/app.php`:

```php
'providers' => [
    ...
    Kingsley\References\ReferencesServiceProvider::class,
];
```

Now publish the config:

```bash
php artisan vendor:publish --provider="Kingsley\References\ReferencesServiceProvider"
```

This is the contents of the published config file:

```php
return [
    /*
     * Name of the database table that
     * will store model references.
     */
    'table_name' => 'references',

    /*
     * Name of the route model binding.
     * Eg. /api/customers/{ref}
     */
    'binding_name' => 'ref',

    /*
     * Whether the reference hash should
     * prefix the shortened model type.
     * Eg. App\Customer -> cus_tKCulsB67hty
     */
    'prefix' => false,
];
```

Now just run the migrations!

```bash
php artisan migrate
```

## Usage

Choose the model that you want to make referenceable. In this example I'll choose `Customer`. We'll import the trait and use it in the class.

```php
namespace App;

use Kingsley\References\Referenceable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Referenceable;
}
```

Now setup your routes to use the binding. Whether you're using a controller or an anonymous function, just type-hint the model class in the arguments to resolve the reference.

```php
Route::get('/api/customer/{ref}', function (Customer $customer) {
    return $customer;
});
```

When submitting AJAX requests from the client, you can use the `ref` attribute that is appended to the model.

```js
ajax.get(`/api/customer/${customer.ref}`);
```

### Prefixes

If you want to prefix references, just set the `prefix` option to `true` in the config. By default it will use the first three characters of the class' basename.

```php
App\Customer -> cus_tKCulsB67hty
```

Alternatively you can explicitly set the prefix for the model by setting the following. Note that if you set it to `null` it won't have a prefix, even if your `prefix` config option is set to `true`.

```php
class Customer extends Model
{
    use Referenceable;

    protected $referencePrefix = 'customer';
}
```
