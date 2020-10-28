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

      $user = User::find(auth()->user()->id);
      $roles = Role::orderBy('name')->get();
       if(empty($user)){
          Flash::error('mensaje error');
         return redirect()->back();
       }

      //dump($user);
      return view('profile.edit', compact('roles', 'user')); 

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
    
        //$user = User::find(auth()->user()->id);
       
        $data =  $request->all();


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
    public function destroy($id)
    {
        //
    }
}
