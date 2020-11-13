<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    
     protected $fillable = [
        'size','location','type',

    ];

     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
