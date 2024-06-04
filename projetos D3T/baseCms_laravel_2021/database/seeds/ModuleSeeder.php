<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_timestamp = date('Y-m-d h:i:s');

        DB::table('modules')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Administração',
                    'father_path' => '',
                    'path' => 'admin',
                    'father_order' => 99,
                    'order' => 0,
                    'icon' => 'fa fa-lock',
                    'has_son' => 1,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 2,
                    'name' => 'Grupos de Usuários',
                    'father_path' => 'admin',
                    'path' => 'groups',
                    'father_order' => 99,
                    'order' => 1,
                    'icon' => '',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 3,
                    'name' => 'Usuários',
                    'father_path' => 'admin',
                    'path' => 'users',
                    'father_order' => 99,
                    'order' => 2,
                    'icon' => '',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 4,
                    'name' => 'Banner',
                    'father_path' => '',
                    'path' => 'banner',
                    'father_order' => 0,
                    'order' => 1,
                    'icon' => 'far fa-image',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 5,
                    'name' => 'Blog',
                    'father_path' => '',
                    'path' => 'blog',
                    'father_order' => 1,
                    'order' => 1,
                    'icon' => 'far fa-newspaper',
                    'has_son' => 1,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 6,
                    'name' => 'Categorias',
                    'father_path' => 'blog',
                    'path' => 'blog_categories',
                    'father_order' => 1,
                    'order' => 1,
                    'icon' => '',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 7,
                    'name' => 'Postagens',
                    'father_path' => 'blog',
                    'path' => 'blog_posts',
                    'father_order' => 1,
                    'order' => 2,
                    'icon' => '',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 8,
                    'name' => 'Configurações',
                    'father_path' => '',
                    'path' => 'configurations',
                    'father_order' => 98,
                    'order' => 1,
                    'icon' => 'fa fa-cog',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 9,
                    'name' => 'Páginas',
                    'father_path' => '',
                    'path' => 'pages',
                    'father_order' => 97,
                    'order' => 0,
                    'icon' => 'far fa-file-lines',
                    'has_son' => 0,  //mudar pra um se for principal
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
/*                 [
                    'id' => 10,
                    'name' => 'teste',
                    'father_path' => 'pages',
                    'path' => 'pages_teste',
                    'father_order' => 97,
                    'order' => 0,
                    'icon' => 'far fa-file-lines',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ], */
                [
                    'id' => 11,
                    'name' => 'Clientes',
                    'father_path' => '',
                    'path' => 'clients',
                    'father_order' => 97,
                    'order' => 3,
                    'icon' => 'fa fa-users',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp
                ],
                [
                    'id' => 12,
                    'name' => 'Produtos',
                    'father_path' => '',
                    'path' => 'products',
                    'father_order' => 7,
                    'order' => 1,
                    'icon' => 'fa fa-rocket',
                    'has_son' => 1,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 13,
                    'name' => 'Categorias',
                    'father_path' => 'products',
                    'path' => 'products_category',
                    'father_order' => 7,
                    'order' => 2,
                    'icon' => 'fa fa-rocket',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
                [
                    'id' => 14,
                    'name' => 'Sub Categorias',
                    'father_path' => 'products',
                    'path' => 'products_sub_category',
                    'father_order' => 7,
                    'order' => 3,
                    'icon' => 'fa fa-rocket',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
/*                 [
                    'id' => 15,
                    'name' => 'Selos',
                    'father_path' => 'products',
                    'path' => 'products_stamp',
                    'father_order' => 7,
                    'order' => 4,
                    'icon' => 'fa fa-rocket',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ], */
                [
                    'id' => 16,
                    'name' => 'Gerenciar Produtos',
                    'father_path' => 'products',
                    'path' => 'products',
                    'father_order' => 7,
                    'order' => 1,
                    'icon' => 'fa fa-rocket',
                    'has_son' => 0,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp,
                ],
            ]
        );

        DB::table('groups')->insert([
            'name' => 'Administrador',
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp,
        ]);

        $modules = DB::table('modules')->get();
        $groups = DB::table('groups')->get();
        foreach ($modules as $module) {
            foreach ($groups as $group) {
                DB::table('group_module')->insert([
                    'group_id' => $group->id, 'module_id' => $module->id,
                ]);
            }
        }
    }
}
