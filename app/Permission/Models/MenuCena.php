<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCena extends Model
{
      
     protected $fillable = [

        'nombrec','descriptionc',

    ];


     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
