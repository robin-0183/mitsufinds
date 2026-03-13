<?php

return [
    /*
     * Fallback when no admin_credentials row exists. After setting credentials in DB,
     * admin email is read from the database. Password is only stored hashed in DB.
     * Set credentials: php artisan admin:set-credentials
     */
    'email' => env('ADMIN_EMAIL'),
];
