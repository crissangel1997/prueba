<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
   

    protected $table = "visitas";
    

    protected $fillable = [

        'name','lastname',

    ];

     protected $primaryKey = 'id';

    public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }

    

}
