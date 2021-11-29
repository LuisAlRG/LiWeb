<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Administrador;
use App\Models\Funcionario;
use App\Models\Historial;
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
        $empleado->save();
        $indInc++;

        $empleado = new Empleado();
        $empleado->nombre = "Daniel Roman";
        $empleado->apellido = "Nuñez Aguirre";
        $password = "meGustaPizza";
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Funcionario();
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();

        $empleado = new Empleado();
        $empleado->nombre = "Luis Alfonso";
        $empleado->apellido = "Rodriguez Gonzalez";
        $password = "EsoDijoElla";
        //$empleado->gerente = false;
        //$empleado->contratado = true;
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Administrador();
        $admin->gerente = false;
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();

        $empleado = new Empleado();
        $empleado->nombre = "Jose Luis";
        $empleado->apellido = "Sanchez Sanchez";
        $password = "atupaehcniPjajajajaJ";
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Funcionario();
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();

        $empleado = new Empleado();
        $empleado->nombre = "Brian";
        $empleado->apellido = "Miranda Aguirre";
        $password = "recursando";
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Funcionario();
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();

        $empleado = new Empleado();
        $empleado->nombre = "Barney";
        $empleado->apellido = "Dinosaurio";
        $password = "toysolito";
        //$empleado->contratado = false;
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Funcionario();
        $admin->contratado = true;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();

        $empleado = new Empleado();
        $empleado->nombre = "Thomas";
        $empleado->apellido = "Tren";
        $password = "weliketoparty2000";
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$indInc.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $admin = new Funcionario();
        $admin->contratado = false;
        $empleado->administrador()->save($admin);
        $empleado->save();
        $indInc++;

        $historial = new Historial();
        $historial->idEmpleado = 1;
        $historial->operacion = "Agrego a un Empleado";
        $historial->save();
    }
}
