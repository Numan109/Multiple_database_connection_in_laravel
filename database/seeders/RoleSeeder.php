<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create Roles

        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleClient = Role::create(['name' => 'client']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);


        //Permission List as array

        $permissions = [

            //Dashboard permissions
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            //User permissions
            [
                'group_name' => 'user',
                'permissions' => [
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                    'user.approve',
                ]
            ],

            //Role
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],

            //Permissions
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission.create',
                    'permission.view',
                    'permission.edit',
                    'permission.delete',
                    'permission.approve',
                ]
            ],

            //Package permissions
            [
                'group_name' => 'package',
                'permissions' => [
                    'package.create',
                    'package.view',
                    'package.edit',
                ]
            ],

            //Customer permissions
            [
                'group_name' => 'customer',
                'permissions' => [
                    'customer.create',
                    'customer.view',
                    'customer.edit',
                ]
            ],

            //Bill permissions
            [
                'group_name' => 'bill',
                'permissions' => [
                    'bill.create',
                    'bill.view',
                    'bill.edit',
                ]
            ],

            //Expense permissions
            [
                'group_name' => 'expense',
                'permissions' => [
                    'expense.create',
                    'expense.view',
                    'expense.edit',
                ]
            ],

            //Account permissions
            [
                'group_name' => 'account',
                'permissions' => [
                    'account.create',
                    'account.view',
                    'account.edit',
                ]
            ],

            //Account permissions
            [
                'group_name' => 'transaction',
                'permissions' => [
                    'transaction.create',
                    'transaction.view',
                    'transaction.edit',
                ]
            ],

        ];

        //Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {

            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {

                //create Permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        //Create and Assign Permissions
        //    for($i = 0; $i < count($permissions); $i++){
        //     //create Permission
        //     $permission = Permission::create(['name' => $permissions[$i]]);
        //     $roleSuperAdmin->givePermissionTo($permission);
        //     $permission->assignRole($roleSuperAdmin);
        //    }
    }
}