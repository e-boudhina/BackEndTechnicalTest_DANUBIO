<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Start Hard coded default users
        User::create([
            'name' =>'Mr. Morgan Caron',
            'email' => 'morgan@quanticfy.io',
            'password' => 'admin',
        ]);
        User::create([
            'name' =>'e-boudhina',
            'email' => 'e-boudhina@live.fr',
            'password' => 'admin',
        ]);
        //End Hard coded default users
    }
}
