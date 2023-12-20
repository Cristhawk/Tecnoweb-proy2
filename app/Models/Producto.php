<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table='producto';
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
		'nombre',
		'precio',	
		'id_categoria',	
    ];
}
