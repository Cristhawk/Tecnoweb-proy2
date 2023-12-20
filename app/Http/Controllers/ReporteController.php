<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
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
    
    public function index()
    {   
        $productos = DB::select("
            SELECT p.id, p.nombre, 
            (SELECT COALESCE(SUM(m.stock), 0) FROM movimiento m WHERE m.id_producto = p.id AND m.tipo = 'Ingreso' and m.estado = 1 ) -
            (SELECT COALESCE(SUM(m.stock), 0) FROM movimiento m WHERE m.id_producto = p.id AND m.tipo = 'Egreso' and m.estado = 1 ) AS stock_actual
            FROM producto p
            WHERE  p.estado = 1  
            ;
        ");
        $arrayProducto = [];
        $arrayStock=[];
        foreach ($productos as $value) {
            array_push($arrayStock,$value->stock_actual);
            array_push($arrayProducto,$value->nombre);
        }

        

        $proveedores = DB::select("
            SELECT usuario.id, usuario.nombre, SUM(detalle_compra.cantidad) AS cantidad_stock, COUNT(detalle_compra.cantidad) AS cantidad_productos
            FROM usuario
            LEFT JOIN compra  ON usuario.id = compra.id_usuario
            LEFT JOIN detalle_compra  ON compra.id = detalle_compra.id_compra 
            where usuario.rol = 'Proveedor' and usuario.estado = 1 and compra.estado = 1 and detalle_compra.estado = 1
            GROUP BY usuario.id, usuario.nombre;
        ");
        $arrayProducto = [];
        $arrayStock=[];

        $arrayProveedor = [];
        $arrayStockP=[];
        foreach ($productos as $value) {
            array_push($arrayStock,$value->stock_actual);
            array_push($arrayProducto,$value->nombre);
        }
        foreach ($proveedores as $value) {
            array_push($arrayProveedor,$value->nombre);
            array_push($arrayStockP,$value->cantidad_stock);
        }
        return view('reporte.index',['arrayProducto'=>$arrayProducto,'arrayStock'=>$arrayStock,'arrayProveedor'=>$arrayProveedor,'arrayStockP'=>$arrayStockP]);
    }
}
