<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // seeder con datos predeterminados
        /*
        $this->call(EmpleadoSeeder::class);
        $this->call(AutorSeeder::class);
        $this->call(EditorialSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(VentaSeeder::class);
        */

        //seeder con un solo usuario para poder hacer cosas desde 0
        
        $this->call(EmpleadoZeroSeeder::class);
        $this->call(GeneroZeroSeeder::class);
        
    }
}
