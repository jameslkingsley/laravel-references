<?php

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
