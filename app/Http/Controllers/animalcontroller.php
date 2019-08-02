<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo;
use App\animal;
class animalcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal= animal::all();
        return response()->json(['animal'=>$animal, 'code'=>'200']) ;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
       if(empty($request->nombre) || empty($request->edad)|| empty($request->tipoanimalid)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }
        $tipo=tipo::find($request->tipoanimalid);
        if((empty($tipo))){
        return response()->json(['message'=>'nivel no encontrado', 'code'=>'404']) ;
       }

        $tipo = new animal();
        $tipo->nombre=$request->nombre;
        $tipo->edad=$request->edad;
        $tipo->tipoanimalid=$request->tipoanimalid;
        $tipo->save();
        return response()->json(['message'=>'Datos creado correctamente', 'code'=>'201']);

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal= animal::find($id);
       if((empty($animal))){
        return response()->json(['message'=>'Animal no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['animal'=>$animal, 'code'=>'200']) ;
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
        if(empty($request->nombre) || empty($request->edad)|| empty($request->tipoanimalid)) {

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }
            $tipo=tipo::find($request->tipoanimalid);
            if((empty($tipo))){
            return response()->json(['message'=>'nivel no encontrado', 'code'=>'404']) ;
           }

        $animal=animal::find($id);
        if(empty($animal)){

                return response()->json(['message'=>'Producto no encontrado', 'code'=>'404']);
        }
        
        $animal->nombre=$request->nombre;
        $animal->edad=$request->edad;
        $animal->tipoanimalid=$request->tipoanimalid;
        $animal->save();
        return response()->json(['message'=>'Animal actualizado', 'code'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($id)) {

            return response()->json(['message'=>'el id es obligatorio', 'code'=>'406']);
        }


        $animal=animal::find($id);
        if(empty($animal)){

                return response()->json(['message'=>'Animal no encontrado', 'code'=>'404']);
        }
        
        $animal->delete();

        return response()->json(['message'=>'animal borrado', 'code'=>'200']);
    }
}
