<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;




class Almuerzo extends Model
{
       protected $fillable = [
        'fecha','description',

    ];

    public function users(){

    	return $this->belongsToMany('App/User')->withTimesTamps();
    }
     public function permissions(){

        return $this->belongsToMany('App\Permission\Models\permission')->withTimesTamps();
    }

    public function malmuerzos(){

        return $this->belongsToMany('App\Permission\Models\MenuAlmuerzo')->withTimesTamps();
    }
   
    
}
