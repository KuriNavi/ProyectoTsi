<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actividades')->insert([
            ['id_usuario'=>2,'nombre_actividad'=>'Court','descripcion'=>'productize bleeding-edge technologies','id_categoria'=>1,'fecha_hora_inicio'=>'2024-01-02 00:00:00','recordatorio'=>'2024-01-02 00:00:00','fecha_hora_termino'=>'2024-01-02 01:00:00'],
            ['id_usuario'=>2,'nombre_actividad'=>'Drive','descripcion'=>'cultivate strategic initiatives','id_categoria'=>2,'fecha_hora_inicio'=>'2024-03-03 00:00:00','recordatorio'=>'2024-03-03 00:00:00','fecha_hora_termino'=>'2024-03-03 01:00:00'],
            ['id_usuario'=>2,'nombre_actividad'=>'Center','descripcion'=>'optimize open-source users','id_categoria'=>3,'fecha_hora_inicio'=>'2024-02-02 00:00:00','recordatorio'=>'2024-02-02 00:00:00','fecha_hora_termino'=>'2024-02-02 01:00:00'],
            ['id_usuario'=>2,'nombre_actividad'=>'Street','descripcion'=>'matrix back-end e-tailers','id_categoria'=>2,'fecha_hora_inicio'=>'2024-02-28 00:00:00','recordatorio'=>'2024-02-28 00:00:00','fecha_hora_termino'=>'2024-02-28 01:00:00'],
            ['id_usuario'=>2,'nombre_actividad'=>'Park','descripcion'=>'scale mission-critical e-commerce','id_categoria'=>1,'fecha_hora_inicio'=>'2024-03-14 00:00:00','recordatorio'=>'2024-03-14 00:00:00','fecha_hora_termino'=>'2024-03-14 01:00:00'],
            ['id_usuario'=>3,'nombre_actividad'=>'Park','descripcion'=>'monetize sticky systems','id_categoria'=>1,'fecha_hora_inicio'=>'2024-05-09 00:00:00','recordatorio'=>'2024-05-09 00:00:00','fecha_hora_termino'=>'2024-05-09 01:00:00'],
            ['id_usuario'=>3,'nombre_actividad'=>'Road','descripcion'=>'implement frictionless networks','id_categoria'=>2,'fecha_hora_inicio'=>'2024-01-24 00:00:00','recordatorio'=>'2024-01-24 00:00:00','fecha_hora_termino'=>'2024-01-24 01:00:00'],
            ['id_usuario'=>3,'nombre_actividad'=>'Terrace','descripcion'=>'facilitate 24/365 supply-chains','id_categoria'=>3,'fecha_hora_inicio'=>'2024-08-24 00:00:00','recordatorio'=>'2024-08-24 00:00:00','fecha_hora_termino'=>'2024-08-24 01:00:00'],
            ['id_usuario'=>3,'nombre_actividad'=>'Street','descripcion'=>'leverage cutting-edge bandwidth','id_categoria'=>3,'fecha_hora_inicio'=>'2024-07-31 00:00:00','recordatorio'=>'2024-07-31 00:00:00','fecha_hora_termino'=>'2024-07-31 01:00:00'],
            ['id_usuario'=>3,'nombre_actividad'=>'Junction','descripcion'=>'grow scalable e-markets','id_categoria'=>2,'fecha_hora_inicio'=>'2024-04-29 00:00:00','recordatorio'=>'2024-04-29 00:00:00','fecha_hora_termino'=>'2024-04-29 01:00:00'],
        ]);
    }
}
