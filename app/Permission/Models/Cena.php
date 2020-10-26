<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Cena extends Model
{  
    

     
    protected $fillable = [

        'fechac','descriptionc',

    ];

    public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
