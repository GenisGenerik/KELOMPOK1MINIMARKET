<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jayusman = Role::create(['name' => 'jayusman']);
        $direktur = Role::create(['name' => 'manager']);
        $direktur = Role::create(['name' => 'supervisor']);
        $direktur = Role::create(['name' => 'kasir']);
        $direktur = Role::create(['name' => 'gudang']);
        $Allpermission = Permission::create(['name' => 'all']);
        $jayusman->givePermissionTo($Allpermission);
        $Allpermission->assignRole($jayusman);
        $Cabangpermission = Permission::create(['name' => 'allCabang']);
        $direktur->givePermissionTo($Cabangpermission);
        $Cabangpermission->assignRole($direktur);
    }
}
