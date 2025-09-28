<?php

namespace Unicodeveloper\Paystack\Test;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Unicodeveloper\Paystack\Paystack;

class HelpersTest extends TestCase
{
    protected Paystack|\Mockery\MockInterface $paystack;
    protected \Mockery\MockInterface $mock;

    public function setUp(): void
    {
        parent::setUp();
        $this->paystack = m::mock(Paystack::class);
        $this->mock = m::mock(\GuzzleHttp\Client::class);
    }

    public function tearDown(): void
    {
        m::close();
        parent::tearDown();
    }

    /**
     * Tests that helper returns
     *
     * @test
     * @return void
     */
    function testReturnsInstanceOfPaystack(): void
    {
        $this->assertInstanceOf(Paystack::class, $this->paystack);
    }
}
