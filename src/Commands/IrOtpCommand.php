<?php

namespace MoShirv\IrOtp\Commands;

use Illuminate\Console\Command;

class IrOtpCommand extends Command
{
    public $signature = 'ir-otp';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
