<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FondosSeeder::class,
            UsuariosSeeder::class,
            PagosSeeder::class,
            CategoriasSeeder::class,
            ActividadesSeeder::class,
        ]);
    }
}
