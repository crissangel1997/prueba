<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Permission\Models\Visita;

use Illuminate\Support\Facades\Validator;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

     //$this->authorize('haveaccess','profile.edit');

       $iduser = auth()->user()->id;

       $role = DB::select('CALL `getRoleName`(?)',[$iduser]);

       $user = User::find(auth()->user()->id);
       $roles = Role::orderBy('name')->get();
       if(empty($user)){
          Flash::error('mensaje error');
         return redirect()->back();
       }

      //dump($user);
      return view('profile.edit', compact('roles', 'user','role')); 

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
    
      
       
        //$data =  $request->all();

        $data = request()->validate([
      
            'name'      => 'max:150|:users,name,'.$user->id,
            'sname'     => 'max:150|:users,sname,'.$user->id,
            'fname'     => 'max:150|:users,fname,'.$user->id,
            'slname'    => 'max:150|:users,slname,'.$user->id,
            'typeident' => 'max:150|:users,typeident,'.$user->id,
            'ident'     => 'max:150|:users,ident,'.$user->id,
            'fnaci'     => 'max:150|:users,fnaci,'.$user->id,
            'direc'     => 'max:150|:users,direc,'.$user->id,
            'email'     => 'max:150|:users,email,'.$user->id,
            'usu'       => 'max:150|:users,usu,'.$user->id,
            'password'  =>  'max:150|confirmed|:users,password,'.$user->id
        ]);

       
    if ($data['password'] != null){

        $data['password'] = bcrypt($data['password']); 
        }
         
    else{
        
             unset($data['password']);
    }
        $update = auth()->user()->update($data); 
         /*Sincroniza con la tabla de permisos y roles*/ 
        $user->roles()->sync($request->get('roles'));

        //dump($update);
    
         if ($update) {

             return  redirect()->route('perfil.edit')->with('status_success','Perfil Usuario  Actualizado Existosamente');

         }else{

               return  redirect()->route('profile')->with('warning','Usuario no actializado');

         }



    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        

    }
}
