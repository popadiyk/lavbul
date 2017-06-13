<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Адміністратор',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'super_user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Кінцевий споживач',
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Корстувач',
                ])->save();
        }
    }
}
