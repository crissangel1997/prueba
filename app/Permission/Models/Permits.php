<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Permits extends Model
{
    
    protected $fillable = [
        'description',

    ];


         public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
