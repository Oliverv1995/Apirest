<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo;
use App\animal;
class animalcontroller extends Controller
{
  
/**
 * @SWG\Get(
 *   path="/animal",
 *   summary="Obtener animales",
   *   tags={"Animales"},
 *   operationId="getCustomerRates",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */
    public function index()
    {
        $animal= animal::all();
        return response()->json(['animal'=>$animal, 'code'=>'200']) ;
    }

    
    /**
     * @SWG\Post(
     *   path="/animal",
     *   tags={"Animales"},
     *   summary="Ingresar animal",
     *   operationId="getCustomerRates2",
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="Ingrese nombre",
     *     required=true,
     *     type="string"
     *   ),
      @SWG\Parameter(
     *     name="edad",
     *     in="formData",
     *     description="Ingrese edad",
     *     required=true,
     *     type="string"
     *   ),
      @SWG\Parameter(
     *     name="tipoanimalid",
     *     in="formData",
     *     description="Ingrese Tipo de animal",
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
     * @SWG\Get(
     *   path="/animal/{id}",
     *   tags={"Animales"},
     *   summary="Obtener animal",
     *   operationId="getanimal",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar id del animal",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="El id del animal existe"),
     *   @SWG\Response(response=422, description="No se permiten valores nulos"),
     * )
     *
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
     * @SWG\Put(
     *   path="/animal/{id}",
     *   tags={"Animales"},
     *   summary="Actualizar animales",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar id del animal",
     *     required=true,
     *     type="integer"
     ),
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="Ingrese nombre",
     *     required=true,
     *     type="string"
     *   ),
      @SWG\Parameter(
     *     name="edad",
     *     in="formData",
     *     description="Ingrese edad",
     *     required=true,
     *     type="string"
     *   ),
      @SWG\Parameter(
     *     name="tipoanimalid",
     *     in="formData",
     *     description="Ingrese Tipo de animal",
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
    * @SWG\Delete(
     *   path="/animal/{id}",
     *   tags={"Animales"},
     *   summary="Eliminar animal",
     *   operationId="deleteanimal",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar el id del animal",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Animal eliminado correctamente"),
     *   @SWG\Response(response=404, description="Animal no encontrado"),
     * )
     *
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
