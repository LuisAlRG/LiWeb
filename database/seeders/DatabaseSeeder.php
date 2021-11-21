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
        $this->call(EmpleadoSeeder::class);
        $this->call(AutorSeeder::class);
        $this->call(EditorialSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(VentaSeeder::class);
    }
}
