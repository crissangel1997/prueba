<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    
     protected $fillable = [
        'permits_id','size','type','ruta','created_at','updated_at',

    ];

     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }
    
    public function permit(){

    	return $this->belongsTo('App\Permission\Models\Permits');
    }
}
