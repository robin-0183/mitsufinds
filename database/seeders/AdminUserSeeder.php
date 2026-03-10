<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Set ADMIN_EMAIL and ADMIN_PASSWORD in your .env to create your admin account.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (empty($email) || empty($password)) {
            $this->command->warn('Set ADMIN_EMAIL and ADMIN_PASSWORD in .env to create your admin user, then run: php artisan db:seed --class=AdminUserSeeder');
            return;
        }

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $user->name ?: 'Admin';
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $this->command->info('Admin user created/updated for: '.$email);
    }
}
