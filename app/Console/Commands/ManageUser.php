<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ManageUser extends Command
{
    public $user;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:manage-user
                                {userId}
                                {--password=}
                                ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Management';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));

        if (!empty($this->option('password')))
        {
            $newPassword = $user->setPassword($this->option('password'));
            $user->save();

            $this->info("User #{$user->id} password changed! Password: {$newPassword}");
        }
    }
}
