<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Permission\Models\MenuAlmuerzo;
use App\Permission\Models\Almuerzo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\Visit;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;

class AmuerzoTolalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        Gate::authorize('haveaccess','almuerzototal.index');


        $busq = [$request->fecha1,  $request->fecha2];

        $almuerzototal = DB::select('CALL `ListAlmuerzoTotal`(?,?)',$busq);
        

        return view('almuerzototal.index',compact('almuerzototal'));
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
         
        $this->authorize('haveaccess','almuerzototal.create');

        $busq = [$request->fecha1,  $request->fecha2];

        $almuerzototal = DB::select('CALL `ListAlmuerzoTotal`(?,?)',$busq);
        //dump($almuerzototal);

        return  view('almuerzototal.index',compact('almuerzototal'));
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
