<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RodionARR\PDOService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\App;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        Gate::authorize('haveaccess','user.index');

          $users = User::with('roles')->orderBy('id','Desc')->where('active','=','1')->paginate(100000);
 
         return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     $this->authorize('haveaccess','user.create');

         $roles = Role::orderBy('name')->get();

        return view('user.create',compact('roles'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $this->authorize('haveaccess','user.create');

               $user = request()->validate([

                'name'     => ['required', 'string', 'max:255'],
                'sname'    => [ 'max:255'],
                'fname'    => [ 'max:150'],
                'slname'   => [ 'max:150'],
                'typeident'=> ['required', 'string', 'max:150'],
                'ident'    => ['required', 'string', 'max:150'],
                'fnaci'    => [ 'max:150'],
                'direc'    => [ 'string', 'max:150'],
                'email'    => [ 'email', 'max:255'],
                'usu'      => ['required', 'string', 'max:150','unique:users,usu'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],


               ]);
         
               $user  = User::create([

                 'name'      =>  $user['name'],
                 'sname'     =>  $user['sname'],
                 'fname'     =>  $user['fname'],
                 'slname'    =>  $user['slname'],
                 'typeident' =>  $user['typeident'],
                 'ident'     =>  $user['ident'],
                 'fnaci'     =>  $user['fnaci'],
                 'direc'     =>  $user['direc'],
                 'email'     =>  $user['email'],
                 'usu'       =>  $user['usu'],
                  
                 'password' => bcrypt($user['password'])
     
                ]);

               
             
                $user->roles()->sync($request->get('roles'));
                 
             
                return  redirect()->route('user.index')->with('status_success','Usuario guardado Existosamente');
                   
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)

    {   
        $this->authorize('view', [$user, ['user.show','userown.show']]);

        $roles = Role::orderBy('name')->get();

        return view('user.view', compact('roles','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      
      $this->authorize('update', [$user, ['user.edit','userown.edit']]);
   
       $roles = Role::orderBy('name')->get();

       //return $roles;

        return view('user.edit', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
       
        $request -> validate([
            'name'      => 'max:150|:users,name,'.$user->id,
            'sname'     => 'max:150|:users,sname,'.$user->id,
            'fname'     => 'max:150|:users,fname,'.$user->id,
            'slname'    => 'max:150|:users,slname,'.$user->id,
            'typeident' => 'max:150|:users,typeident,'.$user->id,
            'ident'     => 'max:150|:users,ident,'.$user->id,
            'fnaci'     => 'max:150|:users,fnaci,'.$user->id,
            'direc'     => 'max:150|:users,direc,'.$user->id,
            'email'     => 'max:150|:users,email,'.$user->id,
            'usu'       => 'max:150|unique:users,usu,'.$user->id
            

        ]);

     /*crear un permiso en donde....si el rol es  = a---Agente entonces el campo se desabilita pero en el formulario
     */
         //dd($request->all());

         $user->update($request->all());

         /*Sincroniza con la tabla de permisos y roles*/
            $user->roles()->sync($request->get('roles'));
        //}


        return  redirect()->route('user.index')->with('status_success','Usuario Actualizado Existosamente');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('haveaccess','user.destroy');
        $user->active='0';
        $user->update();

         return  redirect()->route('user.index')->with('status_success','Usuario Eliminado Existosamente');
        
    }



}
