<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Ventas')->insert([
            'usuario_id'    =>  3,
            'maquina_id'    =>  1,
            'producto_id'   => 1,
            'costo'         => 300,
            'estado'        => 'A', //Apartado
            'cantidad'      => 1,  
        ]);
    }
}
