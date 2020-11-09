<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Permission\Models\Visit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;


class VisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Gate::authorize('haveaccess','visita.index');

        $visitas =  DB::select('CALL `getVisita`()');
           
      
        return view('visita.index',compact('visitas'));


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
        
         $this->authorize('haveaccess','visita.create');

    
        $visitas = [$request->name,  $request->lastname];

       
         DB::select('CALL `insVisita`(?,?)',$visitas);

        return  redirect()->route('visita.index')->with('status_success','¡La visita  ha pedido su almuerzo!');


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
        
        if ($visita = Visit::findOrFail($id))
         {

           $visita->active='1';
           $visita->update(); 
        }

       return  redirect()->route('visita.index')->with('status_success','Almuerzo Actualizado Existosamente');

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
          $this->authorize('haveaccess','almuerzototal.destroy');

        
        

        if ($visita = Visit::findOrFail($id))
         {

           $visita->active='0';
           $visita->update(); 
        }

       return  redirect()->route('visita.index')->with('status_success','Almuerzo Actualizado Existosamente');
  
    }
}
