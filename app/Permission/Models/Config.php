<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
       protected $fillable = [

        'namec','descriptionc','param1','param2','param3','param4','param5',

    ];


     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
 
}
