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
                'password' => 'kesambi@rw1',
            ],
            [
                'name' => 'RW 2',
                'email' => 'rw2@gmail.com',
                'rw_id' => 2, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw2',
            ],
            [
                'name' => 'RW 3',
                'email' => 'rw3@gmail.com',
                'rw_id' => 3, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw3',
            ],
            [
                'name' => 'RW 4',
                'email' => 'rw4@gmail.com',
                'rw_id' => 4, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw4',
            ],
            [
                'name' => 'RW 5',
                'email' => 'rw5@gmail.com',
                'rw_id' => 5, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw5',
            ],
            [
                'name' => 'RW 6',
                'email' => 'rw6@gmail.com',
                'rw_id' => 6, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw6',
            ],
            [
                'name' => 'RW 7',
                'email' => 'rw7@gmail.com',
                'rw_id' => 7, // Assuming this is related to a foreign key
                'role_id' => 2,  // Assuming 2 is the role ID for a regular user
                'password' => 'kesambi@rw7',
            ],
            // Add more users as needed
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
