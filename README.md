# Drop-in Model References

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
