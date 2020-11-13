<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class PermitsType extends Model
{
     protected $fillable = [
        'namept','descriptionpt',

    ];


         public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
}
