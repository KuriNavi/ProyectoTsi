<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            ['nombre_usuario' => 'Generico', 'correo' => 'generico@gmail.com', 'password' =>Hash::make('generico0'), 'plus' =>true, 'id_fondo' => 1],
            ['nombre_usuario'=>'Administrador 1','correo'=>'admin1@gmail.com','password'=>Hash::make('admin1'),'plus'=>true,'id_fondo'=>1],
            ['nombre_usuario'=>'Katrina','correo'=>'kbutts1@marriott.com','password'=>Hash::make('pG71w'),'plus'=>true,'id_fondo'=>1],
        ]);
    }
}
