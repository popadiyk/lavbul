<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'posts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural'   => 'Posts',
                'icon'                  => 'voyager-news',
                'model_name'            => 'TCG\\Voyager\\Models\\Post',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural'   => 'Pages',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'TCG\\Voyager\\Models\\Page',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => 'User',
                'display_name_plural'   => 'Users',
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

//        $dataType = $this->dataType('name', 'categories');
//        if (!$dataType->exists) {
//            $dataType->fill([
//                'slug'                  => 'categories',
//                'display_name_singular' => 'Category',
//                'display_name_plural'   => 'Categories',
//                'icon'                  => 'voyager-categories',
//                'model_name'            => 'TCG\\Voyager\\Models\\Category',
//                'controller'            => '',
//                'generate_permissions'  => 1,
//                'description'           => '',
//            ])->save();
//        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural'   => 'Menus',
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural'   => 'Roles',
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'aboutus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'aboutuses',
                'display_name_singular' => 'Про магазин',
                'display_name_plural'   => 'Налаштування магазину',
                'icon'                  => 'voyager-shop',
                'model_name'            => 'App\AboutUs',
                'controller'            => 'AboutUsController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'groups');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'groups',
                'display_name_singular' => 'Групи товарів',
                'display_name_plural'   => 'Групи товарів',
                'icon'                  => 'voyager-archive',
                'model_name'            => 'App\Group',
                'controller'            => 'Admin\GroupController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'manufactures');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'manufactures',
                'display_name_singular' => 'Постачальники',
                'display_name_plural'   => 'Постачальники',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\Manufacture',
                'controller'            => 'Admin\ManufactureController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Продукти',
                'display_name_plural'   => 'Продукти',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'App\Product',
                'controller'            => 'Admin\ProductsController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'invoices');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'invoices',
                'display_name_singular' => 'накладну',
                'display_name_plural'   => 'Накладні',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'App\Invoice',
                'controller'            => 'Admin\InvoiceController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'clients');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'clients',
                'display_name_singular' => 'клієнта',
                'display_name_plural'   => 'Клієнти',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'App\Client',
                'controller'            => 'Admin\ClientController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'mainproducts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'main_products',
                'display_name_singular' => 'продукт з головної',
                'display_name_plural'   => 'Продукти на головній',
                'icon'                  => 'voyager-paw',
                'model_name'            => 'App\MainProducts',
                'controller'            => 'Admin\MainPageProductController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'masterclasses');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'master_class',
                'display_name_singular' => 'майстер класс',
                'display_name_plural'   => 'Майстер класс',
                'icon'                  => 'voyager-photo',
                'model_name'            => 'App\MasterClass',
                'controller'            => 'Admin\MasterClassController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }


    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
