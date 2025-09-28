<?php

namespace Unicodeveloper\Paystack\Test;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Unicodeveloper\Paystack\Paystack;

class PaystackTest extends TestCase
{
    protected Paystack|\Mockery\MockInterface $paystack;

    /**
     * Mocked HTTP client (if needed)
     *
     * @var \Mockery\MockInterface|\GuzzleHttp\Client
     */
    protected \Mockery\MockInterface $mock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->paystack = m::mock(Paystack::class);
        $this->mock = m::mock('GuzzleHttp\Client');
    }

    protected function tearDown(): void
    {
        m::close();
        parent::tearDown();
    }

    public function testAllCustomersAreReturned(): void
    {
        $this->paystack->shouldReceive('getAllCustomers')->andReturn(['prosper']);

        $result = $this->paystack->getAllCustomers();

        $this->assertIsArray($result);
        $this->assertContains('prosper', $result);
    }

    public function testAllTransactionsAreReturned(): void
    {
        $this->paystack->shouldReceive('getAllTransactions')->andReturn(['transactions']);

        $result = $this->paystack->getAllTransactions();

        $this->assertIsArray($result);
        $this->assertContains('transactions', $result);
    }

    public function testAllPlansAreReturned(): void
    {
        $this->paystack->shouldReceive('getAllPlans')->andReturn(['intermediate-plan']);

        $result = $this->paystack->getAllPlans();

        $this->assertIsArray($result);
        $this->assertContains('intermediate-plan', $result);
    }
}
