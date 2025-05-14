<?php

namespace MoShirv\IrOtp;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use MoShirv\IrOtp\Models\Otp;

class IrOtpService
{
    protected int $expiryMinutes;

    protected int $tokenLength;

    public function __construct()
    {
        $this->expiryMinutes = config('ir-otp.expiry', 5);
        $this->tokenLength = config('ir-otp.length', 6);
    }

    public function generate(string $identifier): string
    {
        // Delete any existing OTPs for this identifier
        Otp::where('identifier', $identifier)->delete();

        $token = Str::padLeft(rand(0, pow(10, $this->tokenLength) - 1), $this->tokenLength, '0');

        Otp::create([
            'identifier' => $identifier,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes($this->expiryMinutes),
        ]);

        return $token;
    }

    public function validate(string $identifier, string $token): bool
    {
        $otp = Otp::where('identifier', $identifier)
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->where('status', 'pending')
            ->first();

        if (! $otp) {
            return false;
        }

        $otp->markAsVerified();

        return true;
    }
}
