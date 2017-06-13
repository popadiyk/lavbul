<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);
        }

        $role = Role::where('name', 'super_user')->firstOrFail();

        if(User::where('role_id', $role->id)->count()) {
            return;
        }

        User::create([
            'name'           => 'SuperUser',
            'email'          => 'super_user@super_user.com',
            'password'       => bcrypt('super_user'),
            'remember_token' => str_random(60),
            'role_id'        => $role->id,
        ]);
    }
}
