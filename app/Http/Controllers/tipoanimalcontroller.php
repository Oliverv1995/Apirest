<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo;

class tipoanimalcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo= tipo::all();
        return response()->json(['tipo'=>$tipo, 'code'=>'200']);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->descripcion)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }

        $tipo = new tipo();
        $tipo->descripcion=$request->descripcion;
        $tipo->save();
        return response()->json(['message'=>'Tipo creado correctamente', 'code'=>'201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo= tipo::find($id);
       if((empty($tipo))){
        return response()->json(['message'=>'Tipo de animal no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['tipo'=>$tipo, 'code'=>'200']) ;
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
        if(empty($request->descripcion)){

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }


        $tipo=tipo::find($id);
        if(empty($tipo)){

                return response()->json(['message'=>'Tipo de animal no encontrado', 'code'=>'404']);
        }
        $tipo->descripcion=$request->descripcion;
        $tipo->save();
        return response()->json(['message'=>'Tipo de animal actualizado', 'code'=>'200']);
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


        $tipo=tipo::find($id);
        if(empty($tipo)){

                return response()->json(['message'=>'Tipo animal no encontrado', 'code'=>'404']);
        }
        
        $tipo->delete();

        return response()->json(['message'=>'Tipo animal borrado', 'code'=>'200']);

    }
    
}
