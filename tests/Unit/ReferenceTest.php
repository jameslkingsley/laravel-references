<?php

namespace Kingsley\References\Test\Unit;

use Illuminate\Support\Facades\Route;
use Kingsley\References\Test\TestCase;
use Kingsley\References\Test\TestCustomer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReferenceTest extends TestCase
{
    /** @test */
    public function referenceIsCreated()
    {
        $customer = TestCustomer::create();

        $this->assertNotNull($customer->ref);
    }

    /** @test */
    public function referenceIsResolvable()
    {
        $customer = TestCustomer::create();

        $resolved = reference($customer->ref);

        $this->assertTrue($customer->id === $resolved->id);
    }

    /** @test */
    public function exceptionIsThrownIfNotFound()
    {
        $this->expectException(ModelNotFoundException::class);

        reference('test');
    }
}
