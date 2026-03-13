<?php

namespace App\Console\Commands;

use App\Models\AdminCredential;
use Illuminate\Console\Command;

class AdminSetCredentialsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:set-credentials
                            {--email= : Admin email address}
                            {--password= : Admin password (will be hashed)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set or update the admin email and password (stored hashed in the database)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->option('email') ?? $this->ask('Admin email');
        $password = $this->option('password') ?? $this->secret('Admin password');

        if (empty(trim($email ?? '')) || empty($password)) {
            $this->error('Email and password are required.');

            return self::FAILURE;
        }

        $email = trim($email);

        $credential = AdminCredential::query()->first();

        if (! $credential) {
            $credential = new AdminCredential;
        }

        $credential->email = $email;
        $credential->password = $password;
        $credential->save();

        $this->info('Admin credentials updated successfully. Email: '.$email);

        return self::SUCCESS;
    }
}
