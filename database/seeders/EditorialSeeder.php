<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editorial = new Editorial();
        $editorial->nombre = "Fondo de Cultura Economica";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Penguin Books";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Plaza y Janes";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "McGill-Queens University Press";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Ediciones UC";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "HarperCollins";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Bloomsbury";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "ALBA";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "ALFAGUARA";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Alianza Editorial";
        $editorial->save();
        $editorial = new Editorial();
        $editorial->nombre = "Impresiones Pooperas";
        $editorial->save();
    }
}
