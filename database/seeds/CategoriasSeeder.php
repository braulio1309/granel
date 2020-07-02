<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Categorias')->insert([
            'nombre'      => 'Harinas',
            
        ]);
    }
}
