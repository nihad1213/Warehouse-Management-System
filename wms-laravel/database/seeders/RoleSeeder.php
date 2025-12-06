<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRoles = ['admin', 'user', 'manager'];
        foreach ($defaultRoles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

    }
}
