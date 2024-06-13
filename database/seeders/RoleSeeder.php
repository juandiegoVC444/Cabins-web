<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create(['name' => 'admin']);
        $cliente = Role::create(['name' => 'cliente']);

        Permission::create(['name' => 'ver'])->assignRole(['admin', 'cliente']);
        Permission::create(['name' => 'todo'])->assignRole('admin');
    }
}
