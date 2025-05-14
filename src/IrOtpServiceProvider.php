<?php

namespace MoShirv\IrOtp;

use MoShirv\IrOtp\Commands\IrOtpCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigration('create_otps_table')
            ->hasCommand(IrOtpCommand::class);
    }

    public function packageRegistered()
    {
        $this->app->singleton('ir-otp', fn () => new IrOtpService);
    }
}
