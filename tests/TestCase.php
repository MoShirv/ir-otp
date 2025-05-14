<?php

namespace MoShirv\IrOtp\Tests;

use MoShirv\IrOtp\IrOtpServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareMigrations();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
        $this->cleanupMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            IrOtpServiceProvider::class,
        ];
    }

    protected function prepareMigrations(): void
    {
        $migrationsPath = __DIR__.'/../database/migrations';

        foreach (glob("$migrationsPath/*.stub") as $stub) {
            rename($stub, str_replace('.stub', '.php', $stub));
        }
    }

    protected function cleanupMigrations(): void
    {
        $migrationsPath = __DIR__.'/../database/migrations';

        foreach (glob("$migrationsPath/*.php") as $file) {
            if (str_ends_with($file, '.stub.php')) {
                continue;
            }
            rename($file, "$file.stub");
        }
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Optional: Set your package config defaults
        $app['config']->set('ir-otp', [
            'expiry' => 5,
            'length' => 6,
        ]);
    }
}
