<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
     protected $fillable = [
        'nombre','direccion',

    ];


         public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }


    public function users(){

    	return $this->belongsToMany('App/User')->withTimesTamps();
    }

}
