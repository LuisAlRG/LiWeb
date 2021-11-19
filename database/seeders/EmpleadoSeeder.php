<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $indInc = 0;

        $empleado = new Empleado();
        $empleado->nombre = "Kenji";
        $empleado->apellido = "Gonzalez Hoshino";
        $password = "passwordchido";
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Administrador();
        $admin->gerente = true;
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        //$empleado->gerente = true;
        //$empleado->contratado = true;
        $empleado->save();
        $indInc++;
    }
}
