<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(MaquinasSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(VentasSeeder::class);
    }
}
