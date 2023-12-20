<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Almacen;
use App\Models\Usuario;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
        $almacenes =Almacen::where('estado',1)->where('nombre', 'LIKE', '%' . trim($busqueda) . '%')->get();
        return view('almacen.index',['almacenes'=>$almacenes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iduser)
    {
        $user = Almacen::findOrFail($iduser);
        return view('almacen.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idAlmacen)
    {        
        $sucursales = Sucursal::get();
       return view('almacen.edit',['almacen'=>Almacen::findOrFail($idAlmacen),'sucursales'=>$sucursales]);
    }

    public function create()
    {  
        $sucursales = Sucursal::get();
       return view('almacen.create',['sucursales'=>$sucursales]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $almacen = new Almacen;
            $almacen->nombre = $request->input('nombre'); 
            $almacen->descripcion = $request->input('descripcion');
            $almacen->id_sucursal = $request->input('sucursal');
            $almacen->estado = 1;
            $almacen->save();
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Administrador registrado correctamente']);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $almacen =  Almacen::findOrFail($request->id);
            $almacen->nombre = $request->input('nombre'); 
            $almacen->descripcion = $request->input('descripcion');
            $almacen->id_sucursal = $request->input('sucursal');
            $almacen->estado = 1;
            $almacen->save();
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Datos del user actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        } 
    }



    public function updateEstado(Request $request)
    {
        try {
            DB::beginTransaction();
            Usuario::updateEstado($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del user actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }

    public function estado(Request $request)
    {
        try {
            DB::beginTransaction();
            $almacen = Almacen::findOrFail($request->input('id'));
            $almacen->estado = 0;
            $almacen->save();
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del usuario actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }

}
