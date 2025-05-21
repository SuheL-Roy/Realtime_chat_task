<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [
            [
                'name' => 'Suhel Roy',
                'email' => 'suhel@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
