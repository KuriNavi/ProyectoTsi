<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FondosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fondos')->insert([
            ['fondo_plus'=>false,'imagen'=>'a.jpg'],
            ['fondo_plus'=>false,'imagen'=>'b.jpg'],
            ['fondo_plus'=>false,'imagen'=>'c.jpg'],
            ['fondo_plus'=>true,'imagen'=>'d.jpg'],
            ['fondo_plus'=>true,'imagen'=>'e.jpg'],
        ]);
    }
}
