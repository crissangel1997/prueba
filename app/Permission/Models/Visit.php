<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
   
    protected $fillable = [

        'name','lastname',

    ];

    public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }

    

}
