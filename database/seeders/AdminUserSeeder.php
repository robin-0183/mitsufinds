<?php

namespace Database\Seeders;

use App\Models\AdminCredential;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates or updates the User record for the admin email stored in admin_credentials.
     */
    public function run(): void
    {
        $adminCredential = AdminCredential::get();

        if (! $adminCredential?->email) {
            $this->command->warn('No admin credentials in database. Run the migration and set credentials with: php artisan admin:set-credentials');

            return;
        }

        $email = $adminCredential->email;
        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $user->name ?: 'Admin';
        $user->email = $email;
        $user->save();

        DB::table('users')->where('id', $user->id)->update([
            'password' => $adminCredential->getRawOriginal('password'),
        ]);

        $this->command->info('Admin user created/updated for: '.$email);
    }
}
