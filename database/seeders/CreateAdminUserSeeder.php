<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $otherRoles = [
            [
                'name' => 'vendor'
            ],
            [
                'name' => 'staff'
            ],
            [
                'name' => 'user'
            ]
        ];
        foreach($otherRoles as $role)
        {
            Role::create($role);
        }

        $otherUsers = [
            [
                'name' => 'Vendor',
                'email' => 'vendor@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'staff',
                'email' => 'staff@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ]
        ];

        foreach($otherUsers as $user)
        {
            $newUser = User::create($user);
            $newUser->assignRole($newUser->id);
        }

        $otherUsersData = [
            [
                'name' => 'user11',
                'email' => 'user1@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user22',
                'email' => 'user2@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user33',
                'email' => 'user3@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user44',
                'email' => 'user4@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user55',
                'email' => 'user5@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user66',
                'email' => 'user6@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user77',
                'email' => 'user7@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user88',
                'email' => 'user8@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user99',
                'email' => 'user9@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user1111',
                'email' => 'user11@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user2222',
                'email' => 'user22@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user3333',
                'email' => 'user33@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user4444',
                'email' => 'user44@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user5555',
                'email' => 'user55@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user66@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user77@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user88@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user99@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user111@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user222@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user333@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user1234@mail.com',
                'password' => bcrypt('123456'),
                'created_by' => '1',
                'updated_by' => '1'
            ]
        ];

        foreach($otherUsersData as $user)
        {
            $newUser = User::create($user);
            $newUser->assignRole(4);
        }

        // // Roles with permission
        //admin

        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo([
            'role-edit',
            'activity-log',
            'account-unblock',
            'all-account-list',
            'all-account-edit',
            'all-account-delete',
            'staff-create'
        ]);
        //staff
        $staffRole = Role::findByName('staff');
        // $staffRole->givePermissionTo([
        //     'user-list',
        //     'user-create',
        //     'user-edit',
        //     'user-delete'
        // ]);
        //user
        $userRole = Role::findByName('user');
        /**
         * Local vendor user seeder end
         */
    }
}
