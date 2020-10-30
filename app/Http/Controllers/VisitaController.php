<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Permission\Models\MenuAlmuerzo;
use App\Permission\Models\Visita;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Gate::authorize('haveaccess','visita.index');

        $visitas = DB::select('CALL `getVisita`()');
           
        // dump($visitas);
        $users = DB::select('CALL `getSelectUsers`()');
 
        $menualmuerzos = DB::select('CALL `getSelectMenuAlmuerzo`()');

        return view('visita.index',compact('visitas', 'menualmuerzos', 'users'));
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
        

         $this->authorize('haveaccess','almuerzo.create');

        //$iduser = auth()->user()->id;

       /* $ValidateVisit = [$request->fechav];*/

        $visitas = [$request->user_id,  $request->fechav, $request->malmuerzo_id, $request->descriptionv];

        /*$ValVisit= DB::select('CALL `getValidateVisit`(?)',$ValidateVisit);
       */
 
       /* $date = date('Y-m-d');*/

         DB::select('CALL `insVisita`(?,?,?,?)',$visitas);

        return  redirect()->route('visita.index')->with('status_success','¡La visita  ha pedido su almuerzo!');
    
        
        /*if ($ValVisit == null)  {

          


         }else{

            return  redirect()->route('visita.index')->with('warning','!La Visita ya tiene su almuerzo!');
      
         }*/


     
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
    public function destroy(Request $request)
    {
       

       $this->authorize('haveaccess','visita.destroy');

        $visita->activev='0';
        $visita->update();

        //dump($visita);

    return  redirect()->route('visita.index')->with('status_success','Almuerzo Eliminado Existosamente');
    }
}
