<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Productos')->insert([
            'nombre'        => 'Arroz',
            'precio'        => 300,
            'categoria_id'  => 1,
            'imagen'        => 'Arroz.jpg'
            
        ]);

        DB::table('Productos')->insert([
            'nombre'        => 'Poroto',
            'precio'        => 500,
            'categoria_id'  => 1,
            'imagen'        => 'Poroto.jpg'


        ]);
    }
}
