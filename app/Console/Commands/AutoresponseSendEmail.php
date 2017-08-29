<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\AutoresponseEmail;

class AutoresponseSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoresponse_email_blast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Autoresponse Email Blast';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        AutoresponseEmail::email_blast();
    }
}
