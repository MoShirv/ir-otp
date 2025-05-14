<?php

namespace MoShirv\IrOtp\Tests\Feature;

use MoShirv\IrOtp\Tests\TestCase;

class IrOtpTest extends TestCase
{
    /** @test */
    public function it_generates_and_stores_otp()
    {
        $otp = app('ir-otp')->generate('09123456789');

        $this->assertDatabaseHas('otps', [
            'identifier' => '09123456789',
            'token' => $otp,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_validates_correct_otp()
    {
        $service = app('ir-otp');
        $token = $service->generate('09123456789');

        $this->assertTrue($service->validate('09123456789', $token));
    }

    /** @test */
    public function it_rejects_invalid_otp()
    {
        $service = app('ir-otp');
        $service->generate('09123456789');

        $this->assertFalse($service->validate('09123456789', 'wrong-code'));
    }
}
