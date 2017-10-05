<?php

namespace Kingsley\References\Test\Unit;

use Kingsley\References\Test\TestCase;
use Kingsley\References\Test\TestCustomer;

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
    public function resolveRouteModelBinding()
    {
        $customer = TestCustomer::create();

        $response = $this->get("/api/laravel-references/{$customer->ref}");

        $response->assertJson($customer->toArray());
    }
}
