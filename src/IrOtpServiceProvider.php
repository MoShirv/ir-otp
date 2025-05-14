<?php

namespace MoShirv\IrOtp;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MoShirv\IrOtp\Commands\IrOtpCommand;

class IrOtpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ir-otp')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ir_otp_table')
            ->hasCommand(IrOtpCommand::class);
    }
}
