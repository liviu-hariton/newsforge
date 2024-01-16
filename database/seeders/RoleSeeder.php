<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        $permission = new Permission();
        $permission->group = 'settings';
        $permission->name = 'update-settings';
        $permission->save();

        $role = new Role();
        $role->name = 'admin';
        $role->save();
        $role->permissions()->attach($permission);
        $permission->roles()->attach($role);

        // front-end user
        $permission = new Permission();
        $permission->group = 'frontend-contact';
        $permission->name = 'submit-contact-form';
        $permission->save();

        $role = new Role();
        $role->name = 'user';
        $role->save();
        $role->permissions()->attach($permission);
        $permission->roles()->attach($role);

        $admin = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $create_post = Permission::where('group', 'settings')->where('name', 'update-settings')->first();
        $create_user = Permission::where('group', 'frontend-contact')->where('name', 'submit-contact-form')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($admin);
        $admin->permissions()->attach($create_post);

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($userRole);
        $user->permissions()->attach($create_user);
    }
}
