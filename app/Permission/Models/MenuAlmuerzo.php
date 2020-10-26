<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class MenuAlmuerzo extends Model
{
     protected $fillable = [
        'nombre','description',

    ];

  
     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
    

    
      public function malmuerzos(){

        return $this->belongsToMany('App\Permission\Models\Almuerzo')->withTimesTamps();
    }

}
