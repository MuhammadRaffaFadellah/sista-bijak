<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example user data
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'rw_id' => null, // Null because it's optional
                'role_id' => 1,  // Assuming 1 is the role ID for admin
                'password' => Hash::make('password123'), // Change as needed
            ],
            [
                'name' => 'RW 1',
                'email' => 'rw1@gmail.com',
                'rw_id' => 1, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'password123',
            ],
            // Add more users as needed
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
