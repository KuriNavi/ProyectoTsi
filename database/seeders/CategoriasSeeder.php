<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre_categoria'=>'Categoria 1','color'=>'fcfbeb', 'id_usuario' => 1],
            ['nombre_categoria'=>'Categoria 2','color'=>'94c889', 'id_usuario' => 1],
            ['nombre_categoria'=>'Categoria 3','color'=>'7c71b3', 'id_usuario' => 1],
        ]);
    }
}
    
