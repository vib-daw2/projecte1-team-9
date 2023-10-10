<?php

namespace App\Console\Commands;

use App\Models\User;
use DB;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if ($user) {
            $user->role = 'admin';
            $user->save();
            $this->info('User ' . $user->email . ' is now an admin');
        } else {
            $this->error('User ' . $this->argument('email') . ' not found');
        }
    }
}