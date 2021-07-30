<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * module manes are user, role, account-authority, activity-log, all-account-list, operator, buyer, seller, island, category, product, inquery, contact
     * @return void
     */
    public function run()
    {
        $permissions = [
           ['name' => 'role-edit', 'display_name' => 'Role edit'],
           ['name' => 'staff-create', 'display_name' => 'Staff create'],
           ['name' => 'activity-log', 'display_name' => 'Activity logs'],
           ['name' => 'account-unblock', 'display_name' => 'Account Unblock'],
           ['name' => 'all-account-list', 'display_name' => 'All account'],
           ['name' => 'all-account-edit', 'display_name' => 'All account edit'],
           ['name' => 'all-account-delete', 'display_name' => 'All account delete'],
           ['name' => 'place-list', 'display_name' => 'Places'],
           ['name' => 'place-create', 'display_name' => 'Place create'],
           ['name' => 'place-edit', 'display_name' => 'Place edit'],
           ['name' => 'place-delete', 'display_name' => 'Place delete'],
           ['name' => 'inquery', 'display_name' => 'Inquery page']
        ];

        foreach ($permissions as $permission) {
             Permission::create($permission);
        }
    }
}
