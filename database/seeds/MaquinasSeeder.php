<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MaquinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Maquinas')->insert([
            'nombre'    => 'Modelo1',
            'provincia' => 'Misiones',
            'ubicacion' => 'Centro',
            
        ]);
    }
}
