<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_recetas')->insert(['nombre' => 'Comida Mexicana', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Comida Italiana', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Comida Argentina', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Postres', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Cortes', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Ensaladas', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categoria_recetas')->insert(['nombre' => 'Desayunos', 'created_at' => now(), 'updated_at' => now()]);
    }
}
