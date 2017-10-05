<?php

namespace Kingsley\References\Test;

use Kingsley\References\Referenceable;
use Illuminate\Database\Eloquent\Model;

class TestCustomer extends Model
{
    use Referenceable;

    protected $table = 'test_customers';
    protected $guarded = [];
    protected $referencePrefix = 'cus';
}
