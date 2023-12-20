<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
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
        $productos =Producto::where('estado',1)->where('nombre', 'LIKE', '%' . trim($busqueda) . '%')->get();
        return view('producto.index',['productos'=>$productos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iduser)
    {
        $user = Producto::findOrFail($iduser);
        return view('producto.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {        
        $categorias = Categoria::get();
       return view('producto.edit',['producto'=>Producto::findOrFail($idProducto),'categorias'=>$categorias]);
    }

    public function create()
    {  
        $categorias = Categoria::get();
       return view('producto.create',['categorias'=>$categorias]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $producto = new Producto;
            $producto->nombre = $request->input('nombre'); 
            $producto->precio = $request->input('precio');
            $producto->id_categoria = $request->input('categoria');
            $producto->estado = 1;
            $producto->save();
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
            $producto =  Producto::findOrFail($request->id);
            $producto->nombre = $request->input('nombre'); 
            $producto->precio = $request->input('precio');
            $producto->id_categoria = $request->input('categoria');
            $producto->estado = 1;
            $producto->save();
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
            $producto = Producto::findOrFail($request->input('id'));
            $producto->estado = 0;
            $producto->save();
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del usuario actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }
}
