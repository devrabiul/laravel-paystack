<?php

namespace Unicodeveloper\Paystack\Test;

use PHPUnit\Framework\TestCase;
use Unicodeveloper\Paystack\TransRef;

class TransRefTest extends TestCase
{
    private $deprecations = [];

    public function setUp(): void
    {
        parent::setUp();
        
        // Capture deprecation notices
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            if ($errno === E_DEPRECATED) {
                $this->deprecations[] = $errstr;
            }
            return false; // Continue with normal error handling
        }, E_DEPRECATED);
    }

    public function tearDown(): void
    {
        restore_error_handler();
        
        // Output any captured deprecations
        if (!empty($this->deprecations)) {
            fwrite(STDERR, "Captured deprecations in " . $this->getName() . ":\n");
            foreach ($this->deprecations as $deprecation) {
                fwrite(STDERR, " - " . $deprecation . "\n");
            }
        }
        
        parent::tearDown();
    }

    public function testGeneratesTokenOfCorrectLength(): void
    {
        $token = TransRef::getHashedToken(32);

        $this->assertIsString($token);
        $this->assertSame(32, strlen($token));
    }

    public function testGeneratesDifferentTokens(): void
    {
        $token1 = TransRef::getHashedToken(16);
        $token2 = TransRef::getHashedToken(16);

        $this->assertNotSame($token1, $token2, 'Tokens should be random');
    }

    public function testUsesDefaultLength(): void
    {
        $token = TransRef::getHashedToken();

        $this->assertSame(25, strlen($token));
    }
}