<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo;

class tipoanimalcontroller extends Controller
{
    /**
 * @SWG\Swagger(
 *   basePath="/api/v0",
 *   @SWG\Info(
 *     title="Oliver API",
 *     version="1.0.0"
 *   )
 * )
 */

    /**
 * @SWG\Get(
 *   path="/tipo",
 *   summary="Animales",
   *   tags={"Tipos de animales"},
 *   operationId="getCustomerRates",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */

    public function index()
    {
        $tipo= tipo::all();
        return response()->json(['tipo'=>$tipo, 'code'=>'200']);
    }

    

    /**
     * @SWG\Post(
     *   path="/tipo",
     *   tags={"Tipos de animales"},
     *   summary="Ingresar Tipo de animal",
     *   operationId="getCustomerRates",
     *   @SWG\Parameter(
     *     name="descripcion",
     *     in="formData",
     *     description="Ingrese tipo de animal",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),)
     * )
     *
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
     * @SWG\Get(
     *   path="/tipo/{id}",
     *   tags={"Tipos de animales"},
     *   summary="Obtener tipo",
     *   operationId="gettipo",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar id del tipo de animal",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="El id del tipo existe"),
     *   @SWG\Response(response=422, description="No se permiten valores nulos"),
     * )
     *
     */
    public function show($id)
    {
        $tipo= tipo::find($id);
       if((empty($tipo))){
        return response()->json(['message'=>'Tipo de animal no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['tipo'=>$tipo, 'code'=>'200']) ;
    }

    
    /*
    **
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Put(
     *   path="/tipo/{id}",
     *   tags={"Tipos de animales"},
     *   summary="Actualizar tipo de animales",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar id del tipo de animal",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="descripcion",
     *     in="formData",
     *     description="Ingresar nuevo tipo de animal",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="usuario no encontrado"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
    * @SWG\Delete(
     *   path="/tipo/{id}",
     *   tags={"Tipos de animales"},
     *   summary="Eliminar tipo de animal",
     *   operationId="deletetipo",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar el id tipo de animal",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Tipo eliminado correctamente"),
     *   @SWG\Response(response=404, description="Tipo no encontrado"),
     * )
     *
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
