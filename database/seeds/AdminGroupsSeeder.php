<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminGroupsSeeder extends Seeder
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
            'name' => 'groups',
            'slug' => 'groups',
            'display_name_singular' => 'Групи товарів',
            'display_name_plural' => 'Групи товарів',
            'icon' => 'voyager-archive',
            'model_name' => 'App\Group',
            'controller' => 'Admin\GroupController',
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
            'data_type_id' => 8,
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
            'data_type_id' => 8,
            'field' => 'title',
            'type' => 'checkbox',
            'display_name' => 'Title',
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
            'data_type_id' => 8,
            'field' => 'group_id',
            'type' => 'checkbox',
            'display_name' => 'Group Id',
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
            'data_type_id' => 8,
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
            'order' => 4,
        ]);

        /**
         * Створення пункту меню в таблиці menu_items
         */
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'title' => 'Групи товарів',
            'url' => '/admin/groups',
            'target' => '_self',
            'icon_class' => 'voyager-archive',
            'color' => '#000000',
            'parent_id' => null,
            'order' => 14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * У таблиці permissions створюємо можливі дозволи для нашого меню (пр. AboutUs)
         */

        DB::table('permissions')->insert([
            'key' => 'browse_groups',
            'table_name' => 'groups',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'read_groups',
            'table_name' => 'groups',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'edit_groups',
            'table_name' => 'groups',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'add_groups',
            'table_name' => 'groups',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);
        DB::table('permissions')->insert([
            'key' => 'delete_groups',
            'table_name' => 'groups',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_group_id' => null,
        ]);

        /**
         * У таблиці permission_role роздаємо доступи для юзерів (в нашому видпадку надаємо доступ тільки адміну)
         */

        DB::table('permission_role')->insert([
            'permission_id' => 40,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 41,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 42,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 43,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 44,
            'role_id' => 1,
        ]);


    }
}