<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'siswa',
            'display_name' => 'Siswa'
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator'
        ]);
    }
}