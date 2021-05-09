<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'type' => '0',
            'phone' => '0978456321',
            'address' => 'bahan',
            'dob' => '1990-01-10'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'type' => '1',
            'phone' => '0978456987',
            'address' => 'tamwe',
            'dob' => '1995-05-15'
        ]);
    }
}
