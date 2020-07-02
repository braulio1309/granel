<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Cristian',
            'email'     => 'cristianstanganelli@gmail.com',
            'password'  =>  Hash::make('1234'),
            'provincia' => 'Misiones',
            'role'      => 'A' //admin
        ]);

        DB::table('users')->insert([
            'name'      => 'Braulio',
            'email'     => 'brauliozapatad@gmail.com',
            'password'  =>  Hash::make('pepipepi'),
            'provincia' => 'Buenos Aires',
            'role'      => 'A' //admin
        ]);

        DB::table('users')->insert([
            'name'      => 'prueba',
            'email'     => '@gmail.com',
            'password'  =>  Hash::make('pepipepi'),
            'provincia' => 'Buenos Aires',
            'role'      => 'C' //cliente
        ]);
    }
}
