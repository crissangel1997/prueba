<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
     protected $fillable = [

        'fechav','descriptionv',

    ];

      public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
