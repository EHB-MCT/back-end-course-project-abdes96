<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run()
    {
        User::create([
            'name' => 'docent',
            'email' => 'admin@example.com',
            'password' => Hash::make('backendisawesome'),
            'role' => 'admin',
        ]);
    }

}
