<?php

namespace MoShirv\IrOtp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MoShirv\IrOtp\IrOtp
 */
class IrOtp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \MoShirv\IrOtp\IrOtp::class;
    }
}
