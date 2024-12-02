<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pagos')->insert([
            ['id_usuario'=>1,'fecha_compra'=>'2023-11-13 00:00:00'],
            ['id_usuario'=>2,'fecha_compra'=>'2024-4-23 00:00:00'],
        ]);
    }
}
