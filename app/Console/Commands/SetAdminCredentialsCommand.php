<?php

namespace App\Console\Commands;

use App\Models\AdminCredential;
use Illuminate\Console\Command;

class SetAdminCredentialsCommand extends Command
{
    protected $signature = 'admin:set-credentials
                            {email? : Admin email address}
                            {--password= : Admin password (will be hashed)}';

    protected $description = 'Set or update the admin email and password (stored hashed in the database)';

    public function handle(): int
    {
        $email = $this->argument('email') ?? $this->ask('Admin email');
        $password = $this->option('password') ?? $this->secret('Admin password');

        if (empty(trim((string) $email))) {
            $this->error('Email is required.');

            return self::FAILURE;
        }

        if (empty($password)) {
            $this->error('Password is required.');

            return self::FAILURE;
        }

        $credential = AdminCredential::get();

        if ($credential) {
            $credential->email = trim((string) $email);
            $credential->password = $password;
            $credential->save();
            $this->info('Admin credentials updated.');
        } else {
            AdminCredential::query()->create([
                'email' => trim((string) $email),
                'password' => $password,
            ]);
            $this->info('Admin credentials created.');
        }

        return self::SUCCESS;
    }
}
