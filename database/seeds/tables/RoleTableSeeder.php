<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        $roles = Config::get('roles.roles');
        foreach($roles as $role) {
            Role::firstOrCreate($role);
        }
    }

}