<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\Permits;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use DB; 


class PermitsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Gate::authorize('haveaccess','permisouser.index');
        $iduser = auth()->user()->id;

        $permisouser = DB::select('CALL `getPermisoUser`(?)',[$iduser]);
        $users = DB::select('CALL `getSelectUsers`()');
        $permisotipo = DB::select('CALL ` getPermirsotipo`()');
        $permiestado  = DB::select('CALL `getPermitStatus`()');
       
        //dump($permisouser);

        return view('permisouser.index',compact('permisouser','users', 'permisotipo','permiestado'));
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
         
        $this->authorize('haveaccess','permisouser.create');

        $iduser = auth()->user()->id;
       

       $permisouser = [$request->fechainicio, $request->fechafinal, $request->horainicio, $request->horafinal, $iduser, $request->permittype_id, $request->description, $request->permitstatus_id];

       DB::select('CALL `insPermisoUser`(?,?,?,?,?,?,?,?)',$permisouser);



       return  redirect()->route('permisouser.index')->with('status_success','Permiso Registrado Exitosamente');


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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
