<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\Permits;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB; 

class PermitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

         Gate::authorize('haveaccess','permiso.index');

         $permisos = DB::select('CALL `getPermits`()');

        //dump($permiso);

         $users = DB::select('CALL `getSelectUsers`()');


         $permisotipo = DB::select('CALL ` getPermirsotipo`()');
            
         $permiestado  = DB::select('CALL `getPermitStatus`()');

        return view('permiso.index',compact('permisos','users','permisotipo','permiestado'));
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

        $permiso = [$request->fechainicio, $request->fechafinal, $request->horainicio, $request->horafinal, $request->user_id, $request->permittype_id, $request->description, $request->permitstatus_id];

      //  dump($permiso);

          DB::select('CALL `insPermiso`(?,?,?,?,?,?,?,?)',$permiso); 


        return  redirect()->route('permiso.index')->with('status_success','Permiso Registrado Exitosamente');


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
    public function edit(Permits $permiso)
    {
        
        $this->authorize('haveaccess','permiso.edit');
        
         $users = DB::select('CALL `getSelectUsers`()');

         $permisotipo = DB::select('CALL ` getPermirsotipo`()');
            
         $permiestado  = DB::select('CALL `getPermitStatus`()');

      
        return view('permiso.edit',compact('permiso','users','permisotipo','permiestado'));
    


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permits $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permits $permiso)
    {
    
        $this->authorize('haveaccess','permiso.destroy');

        $permiso->active='0';
        $permiso->update();

        return  redirect()->route('permiso.index')->with('status_success','Permiso Eliminado Existosamente');


    }
}
