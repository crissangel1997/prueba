<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Permission\Models\MenuCena;
use App\Permission\Models\Cena;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;

class CenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Gate::authorize('haveaccess','cena.index');
        $iduser = auth()->user()->id;

        $cenas = DB::select('CALL `getCena`(?)',[$iduser]);

       $menucenas = DB::select('CALL `getSelectMenuCena`()');
        
       
        //dump($cenas);
        return view('cena.index',compact('cenas', 'menucenas'));
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
        
        $this->authorize('haveaccess','cena.create');

        $iduser = auth()->user()->id;

        $ValidateCena = [$iduser,  $request->fechac];
        $cenas = [$iduser,  $request->fechac, $request->menucena_id, $request->descriptionc,$request->sede];

        $ValCen = DB::select('CALL `getValidateCena`(?,?)',$ValidateCena);
       
  
     
     $date = date('Y-m-d');
    
        
        if ($ValCen == null)  {

            DB::select('CALL `insCena`(?,?,?,?,?)',$cenas);

            return  redirect()->route('cena.index')->with('status_success','¡El usuario '.auth()->user()->name.'  '.auth()->user()->fname.'  ha pedido su cena!');


         }else{

            return  redirect()->route('cena.index')->with('warning','¡El usuario '.auth()->user()->name.'  '.auth()->user()->fname.' ya tiene su cena!');
      
         }
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
    public function destroy(Cena $cena)
    {
        $this->authorize('haveaccess','cena.destroy');

        $cena->active='0';
        $cena->update();

        return  redirect()->route('cena.index')->with('status_success','Cena Eliminada Existosamente');
    }
}
