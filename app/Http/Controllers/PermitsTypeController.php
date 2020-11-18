<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\PermitsType;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use DB; 



class PermitsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
     Gate::authorize('haveaccess','permisotipo.index');

         $permisotipo = DB::select('CALL ` getPermirsotipo`()');

        //dump($permisotipo);

        return view('permisotipo.index',compact('permisotipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('haveaccess','permisotipo.create');

        $permisotipo = [$request->nombrept, $request->descriptionpt];

             DB::select('CALL `insPermisotype`(?,?)',$permisotipo);

        return  redirect()->route('permisotipo.index')->with('status_success','Tipo De Permiso Registrado Exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PermitsType $permisotipo)
    {
        
        $this->authorize('haveaccess','permisotipo.edit');


         return view('permisotipo.edit',compact('permisotipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermitsType $permisotipo)
    {
        
         $request -> validate([

            'nombrept'       => 'required|max:250|:permits_types,nombrept,'.$permisotipo->id,
            'descriptionpt'  => 'required|max:250|:permits_types,descriptionpt,'.$permisotipo->id
            

        ]);


      $permisotipo->update($request->all());
      

        return  redirect()->route('permisotipo.index')->with('status_success','Permiso Actualizado Existosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermitsType $permisotipo)
    {
        $permisotipo->active='0';
        $permisotipo->update();

       return  redirect()->route('permisotipo.index')->with('status_success','Tipo De Permiso Eliminado Existosamente');
       
    }
}
