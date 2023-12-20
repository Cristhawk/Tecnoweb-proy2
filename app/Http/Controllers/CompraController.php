<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Compra;
use App\Models\Almacen;
use App\Models\Usuario;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
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
        $busqueda = trim($request->input('busqueda'));
        $compras =Compra::where('estado',1)->get();
        return view('compra.index',['compras'=>$compras]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iduser)
    {
        $user = Compra::findOrFail($iduser);
        return view('compra.show',['user'=>$user]);
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
       return view('compra.edit',['almacen'=>Almacen::findOrFail($idAlmacen),'sucursales'=>$sucursales]);
    }

    public function create()
    {  
        $sucursales = Sucursal::get();
       return view('compra.create',['sucursales'=>$sucursales]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $compra = new Compra;
            $compra->glosa = $request->input('glosa'); 
            $compra->id_proveedor = $request->input('proveedor');
            $compra->id_usuario = $request->input('usuario');
            $compra->save();
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
            $compra =  Compra::findOrFail($request->id);
            $compra->glosa = $request->input('glosa'); 
            $compra->id_proveedor = $request->input('proveedor');
            $compra->id_usuario = $request->input('usuario');
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
            $compra = Compra::findOrFail($request->input('id'));
            $compra->estado = 0;
            $compra->save();
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado de la compra actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }

}
