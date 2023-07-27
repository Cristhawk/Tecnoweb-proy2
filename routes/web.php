<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/trigger/{data}', function ($data) {
    echo "<p>You have sent $data</p>";
    event(new App\Events\GetRequestEvent($data));
});

Route::get('/welcome', function () {
    return view('home');
});

Auth::routes();


Route::get('/', function () {
    if (Auth::check()){
        return redirect('/user');
    }else{
        return view('auth.login');     
    }
})->name('login');


Route::get('/error', function () {
    if (Auth::check()){
        return view('error');
    }else{
        return redirect('/');            
    }
});


Route::post('logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
Route::get('login', [App\Http\Controllers\Auth\LoginController::class,'redirectLogin']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class,'login']);


Route::get('/login', function () {
    if (Auth::check()){
        return redirect('/user');
    }else{
        return redirect('/');            
    }
});

Route::get('/home', function () {
    if (Auth::check()){
        return redirect('/user');
    }else{
        return redirect('/login');            
    }
});




Route::get('user',[App\Http\Controllers\UserController::class,'index']);
Route::get('user/create',[App\Http\Controllers\UserController::class,'create']);
Route::post('user/create',[App\Http\Controllers\UserController::class,'store']);
Route::post('user/estado',[App\Http\Controllers\UserController::class,'estado']);
Route::post('user/update',[App\Http\Controllers\UserController::class,'update']);
Route::get('user/search',[App\Http\Controllers\UserController::class,'search']);
Route::get('user/{id}',[App\Http\Controllers\UserController::class,'show']);
Route::get('user/{id}/edit',[App\Http\Controllers\UserController::class,'edit']);



Route::get('lienzo',[App\Http\Controllers\LienzoController::class,'index']);
Route::get('lienzo/create',[App\Http\Controllers\LienzoController::class,'create']);
Route::post('lienzo/create',[App\Http\Controllers\LienzoController::class,'store']);
Route::get('lienzo/{id}',[App\Http\Controllers\LienzoController::class,'show']);
Route::get('lienzo/{id}/edit',[App\Http\Controllers\LienzoController::class,'edit']);
Route::post('lienzo/update',[App\Http\Controllers\LienzoController::class,'update']);
Route::post('lienzo/delete',[App\Http\Controllers\LienzoController::class,'destroy']);


Route::get('perfil',[PerfilController::class,'index'])->name('perfil.index');

Route::patch('/perfil/{user}/{modo}',[PerfilController::class,'updateDiaNoche'])->name('perfil.diaNoche');

Route::get('participante',[App\Http\Controllers\ParticipanteController::class,'index']);
Route::get('participante/{id}',[App\Http\Controllers\ParticipanteController::class,'show']);
Route::post('participante/lienzo/enviarMovimiento',[App\Http\Controllers\ParticipanteController::class,'enviarMovimiento']);
Route::post('participante/lienzo/generarVozAyuda',[App\Http\Controllers\ParticipanteController::class,'generarVozAyuda']);
