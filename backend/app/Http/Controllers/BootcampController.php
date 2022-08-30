<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use File;
use Illuminate\Support\Facades\Hash;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "Aquí se van a mostrar proximamente todos los BootCamps";
        //return Bootcamp::all();
        return response()->json(["Success" => true,
                                  "data" => Bootcamp::all()
                                ] , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "Aquí se crean, insertan los BootCamps";
        //Verificar que llegó aquí el payload
        //return $request->all();
        //Registrar el bootcamp a partir del payload
        $newBootcamp = new Bootcamp();
        $newBootcamp->name = $request->input("name");
        $newBootcamp->description = $request->input("description") ;
        $newBootcamp->website = $request->input("website");
        $newBootcamp->phone = $request->input("phone");       
        $newBootcamp->user_id = $request->input("user_id");
        $newBootcamp->save();
            
        return $newBootcamp;

        return response()->json(["Success" => true,
                                 "data" => $newBootcamp,
                                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo "Aquí se van a mostar los BootCamps cuyo id es: $id";
        //return Bootcamp::find($id);
        return response()->json(["Success" => true,
                                 "data" => Bootcamp::find($id),
                                ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "Aquí se van a actualizar el BootCamp con id: $id";
        //1. Seleccionar el bootcamp por id
        $bootcamp = Bootcamp::find($id);
        //2. Actualizarlo
        $bootcamp->update(
            $request->all()
        );
        //3. Hacer el response respectivo
        return $bootcamp;

        return response()->json(["Success" => true,
                                 "data" => $bootcamp,
                                ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //1. Seleccionas el bootcamp 
        $bootcamp = Bootcamp::find($id);
        //2. Eliminar ese bootcamp
        $bootcamp->delete();
        //3. Response
        return response()->json(["message" => "Bootcamp eliminado",
                                "Success" => true,
                                "data" => $bootcamp->id,
                               ], 200);
    }
}
