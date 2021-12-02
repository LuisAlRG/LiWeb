<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmpleadoZeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indInc = 0;

        $empleado = new Empleado();
        $empleado->nombre = "Admin";
        $empleado->apellido = "Nistrador";
        $password = "Paswor[poderosisimo)DemaciadoPetente";
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
        $empleado->save();
        $indInc++;
    }
}
