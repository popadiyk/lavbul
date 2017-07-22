<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_database',
            'browse_media',
            'browse_settings',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('pages');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('posts');

        Permission::generateFor('categories');

        Permission::generateFor('aboutuses');

        Permission::generateFor('groups');

        Permission::generateFor('manufactures');

        Permission::generateFor('products');

        Permission::generateFor('invoices');

        Permission::generateFor('clients');

        Permission::generateFor('main_products');

        Permission::generateFor('master_class');

        Permission::generateFor('news');


    }
}
