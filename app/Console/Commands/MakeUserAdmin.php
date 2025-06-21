<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email : The email of the user to make admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a user an administrator';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return Command::FAILURE;
        }
        
        if ($user->is_admin) {
            $this->info("User {$user->name} ({$email}) is already an admin.");
            return Command::SUCCESS;
        }
        
        $user->update(['is_admin' => true]);
        
        $this->info("User {$user->name} ({$email}) has been made an administrator.");
        
        return Command::SUCCESS;
    }
}
