<?php

namespace App\Models;

use DB;
use Auth;
use File;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Authenticatable
{
    protected $table='usuario';
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
		'nombre',
		'email',	
		'password',	
		'rol',	
		'remember_token',	
        'created_at', 
        'updated_at', 
        'is_dia', 
        'tema'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getUsuarioPorEmail($query,$email)
    {
    	return $query->where('email',$email)->first();
    }


    public function scope_getAdministradores($query)
    {
        return $query->where('estado',1)->orderBy('id','desc')->get();
    }

    public function scope_getJugadores($query)
    {
        return $query->orderBy('id','desc')->where('estado',0)->where('tipoUsuario',2)->get();
    }

    public function scope_getParticipantePorId($query,$id)
    {
        return $query->where('id',$id)->first();
    }

    //RELATIONSHIPS
    public function participaciones()
    {
        return $this->hasMany('App\Models\Participante','idUser','id')->where('estado',0);
    }

   
    //STATICS
    public static function verificarAdministradorHabilitadoPorEmail($email)
    {
       	$usuario = Usuario::_getUsuarioPorEmail($email);
       	if ($usuario->estado==0) {
       		return true;
       	}else{
       		return false;
       	}
    }
    

    public static function verificarAdministrador($email)
    {
        $usuario = Usuario::_getUsuarioPorEmail($email);
        if ($usuario->tipoUsuario==1) {
            return true;
        }else{
            return false;
        }
    }
    

    public static function createAdministrador($request)
    {

        $usuario = new Usuario;
        $usuario->nombre = $request->input('name'); 
        $usuario->email = $request->input('email');
        $usuario->id_grupo = $request->input('rol');   
        $usuario->tema = "Juvenil";   
        $usuario->is_dia = false;   
        $usuario->password =  Hash::make($request->input('password'));
        $usuario->save();
        return $usuario;
    }

    public static function createDirectorioPorIdAdministrador($idusuario)
    {
        $destinationPath = public_path().'/administradores/'.$idusuario;
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }


    public static function actualizarPerfilPorIdAdministrador($request,$idusuario,$destinationPath)
    {
        if ($request->file('perfil')) {
            $file = $request->file('perfil');
            $usuario = Usuario::findOrFail($idusuario);
            $usuario->perfil = '/administradores/'.$idusuario.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $usuario->perfil);
            $usuario->update(); 
            return $usuario;
        }
    }


    public static function updateAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->nombre = $request->input('name'); 
        $usuario->email = $request->input('email');
        $usuario->id_grupo = $request->input('rol');   
        if ($request->input('password')) {
            $usuario->password =  Hash::make($request->input('password'));
        }
        $usuario->update();
        return $usuario;
    }



    public static function verificarEmailExiste($request)
    {
        $emails = DB::table('usuario')->where('email',$request->input('email'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }

    public static function verificarEmailExisteMenosAdministradorAEditar($request)
    {
        $emails = DB::table('usuario')->where('email',$request->input('email'))->where('usuario.id','<>',$request->input('id'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function estadoAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->estado =0;
        $usuario->update();
        return $usuario;
    }

}
