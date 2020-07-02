<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Stock')->insert([
            'maquina_id'   => 1,
            'producto_id'  =>  1,
            'cantidad'     => 100,
            
        ]);

        DB::table('Stock')->insert([
            'maquina_id'   => 2,
            'producto_id'  =>  1,
            'cantidad'     => 50,  
        ]);

        DB::table('Stock')->insert([
            'maquina_id'   =>  1,
            'producto_id'  =>  2,
            'cantidad'     => 75,  
        ]);

        DB::table('Stock')->insert([
            'maquina_id'   =>  2,
            'producto_id'  =>  1,
            'cantidad'     => 100,  
        ]);
    }
}
