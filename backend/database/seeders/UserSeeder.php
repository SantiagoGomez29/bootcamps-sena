<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App\Models\User;
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
        //1.Leer el archivo de datos

        $json=File::get('database/_data/users.json');

        //2.Convertir los datos en un arreglo

        $arreglo_usuarios=json_decode($json);

        //3.Recorrer el arreglo
        //var_dump($arreglo_usuarios);

        foreach($arreglo_usuarios as $usuario){

          //4.Por cada elemento del arreglo, crear un <<Entity>>
          //Registrar el usuario en la base de datos
          //Se utiliza el metodo :: CREATE  
          User::create([
              "name"=> $usuario->name,
              "email" => $usuario->email,
              "password" => Hash::make(
                                    $usuario->password
                                    )
          ]);


        }

    }
}
