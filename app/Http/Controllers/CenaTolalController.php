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
use App\Permission\Models\Visit;
use RodionARR\PDOService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CenaExport;

use Illuminate\Support\Facades\App;
use DB;

class CenaTolalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        Gate::authorize('haveaccess','cenatotal.index');

        $busqueda = [$request->fecha1,  $request->fecha2];

        $cenatotal = DB::select('CALL `ListCenaTotal`(?,?)',$busqueda);
       
        return  view('cenatotal.index',compact('cenatotal'));


        
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
        

        Gate::authorize('haveaccess','cenatotal.create');

        $busqueda = [$request->fecha1,  $request->fecha2];

        $cenatotal = DB::select('CALL `ListCenaTotal`(?,?)',$busqueda);
     

        return  view('cenatotal.index',compact('cenatotal'));

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

        $this->authorize('haveaccess','cenatotal.destroy');

        
        $cena = Cena::find($id);
        $cena->active='0';
        $cena->update();

      

      return  redirect()->route('cenatotal.index')->with('status_success','Almuerzo Eliminado Existosamente'); 
        
    }

    public function exportExcel(){


       return Excel::download(new CenaExport, 'cena-total.xlsx');

    }
}
