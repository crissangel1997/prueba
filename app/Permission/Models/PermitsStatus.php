<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class PermitsStatus extends Model
{
    
      protected $fillable = [
        'namep','description',

    ];


         public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
