<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permission\Traits\UserTrait;
use App\Permission\Models\Role;
use App\Permission\Models\Sede;

use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

class User extends Authenticatable
{
    use Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array


     */
    protected $table = "users";
    protected $fillable = [
        'name','sname', 'fname','slname','typeident','ident','fnaci', 'direc','email','usu', 'password',   'current_sign_in_at', 'last_sign_in_at', 'host_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  protected $primaryKey = 'id';
  
    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

     public function adminlte_desc()
    { 

          

    }


      public function adminlte_profile_url()
    {

        return 'profile';
    }

     public function sedes(){


        return $this->hasOne('App\Permision\Models\Sede');
    }
    

  
}
