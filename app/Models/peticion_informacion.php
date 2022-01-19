<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peticion_informacion extends Model {
	    use HasFactory;
	    protected $table = 'peticiones_informacion';
	    protected $fillable = [
	        'tutorGrupo',
	        'alumno',
	        'observaciones'
	    ];
}
