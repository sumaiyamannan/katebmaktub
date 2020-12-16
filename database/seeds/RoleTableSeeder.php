<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role_editor_user = new Role;
        $role_editor_user->name = 'editor';
        $role_editor_user->description = 'Can edit authors';
        $role_editor_user->save();

        $role_admin_user = new Role;
        $role_admin_user->name = 'admin';
        $role_admin_user->description = 'Full Access of an administrator';
        $role_admin_user->save();

    }
}
