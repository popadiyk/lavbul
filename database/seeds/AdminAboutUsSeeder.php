<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminAboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Створення BREAD в таблиці data_types
         */
        DB::table('data_types')->insert([
            'name' => 'aboutuses',
            'slug' => 'aboutus',
            'display_name_singular' => 'Про магазин',
            'display_name_plural' => 'Налаштування магазину',
            'icon' => 'voyager-shop',
            'model_name' => 'App\AboutUs',
            'controller' => 'AboutUsController',
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Заповнення по BREAD створеної таблиці (в нас AboutUs)
         */
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'id',
            'type' => 'checkbox',
            'display_name' => 'Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => '',
            'order' => 1,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'name',
            'type' => 'checkbox',
            'display_name' => 'Name',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 2,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'min_logo',
            'type' => 'checkbox',
            'display_name' => 'Min Logo',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 3,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'max_log',
            'type' => 'checkbox',
            'display_name' => 'Max Log',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 4,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'description',
            'type' => 'checkbox',
            'display_name' => 'Description',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 5,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'full_description',
            'type' => 'checkbox',
            'display_name' => 'Full Description',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 6,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'contact_id',
            'type' => 'checkbox',
            'display_name' => 'Contact Id',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '',
            'order' => 7,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'created_at',
            'type' => 'timestamp',
            'display_name' => 'Created At',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 0,
            'delete' => 1,
            'details' => '',
            'order' => 8,
        ]);
        DB::table('data_rows')->insert([
            'data_type_id' => 7,
            'field' => 'updated_at',
            'type' => 'timestamp',
            'display_name' => 'Updated At',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => '',
            'order' => 9,
        ]);

        /**
         * Створення пункту меню в таблиці menu_items
         */
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'title' => 'Налаштування магазину',
            'url' => '/admin/aboutus',
            'target' => '_self',
            'icon_class' => 'voyager-shop',
            'color' => '#000000',
            'parent_id' => null,
            'order' => 13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * У таблиці permissions створюємо можливі дозволи для нашого меню (пр. AboutUs)
         */

        DB::table('permissions')->insert([
            'key' => 'browse_aboutuses',
            'table_name' => 'aboutuses',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'read_aboutuses',
            'table_name' => 'aboutuses',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'edit_aboutuses',
            'table_name' => 'aboutuses',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'add_aboutuses',
            'table_name' => 'aboutuses',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'delete_aboutuses',
            'table_name' => 'aboutuses',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);

        /**
         * У таблиці permission_role роздаємо доступи для юзерів (в нашому видпадку надаємо доступ тільки адміну)
         */

        DB::table('permission_role')->insert([
            'permission_id' => 35,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 36,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 37,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 38,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 39,
            'role_id' => 1,
        ]);


    }
}