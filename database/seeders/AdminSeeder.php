<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@bimbel.com',
            'password' => Hash::make('password'),
            'role_id' => 2, 
        ]);

        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@test.com',
            'password' => Hash::make('password'),
            'role_id' => 1, 
        ]);
    }
}