<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\Visit;
use RodionARR\PDOService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CenaExport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
      $confighoras = DB::select('CALL `getconfighora`()');
      

     return view('confighora.index',compact('confighoras'));
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


           $confighoras = [$request->namec,$request->descriptionc,$request->param1,$request->param2,$request->param3,$request->param4,$request->param5];

          DB::select('CALL `insconfighora`(?,?,?,?,?,?,?)',$confighoras);

           //dump($confighoras);
         return  redirect()->route('confighora.index')->with('status_success','Hora Limite Registrada Existosamente');


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
    public function edit(Config $confighora)
    {

    
         return view('confighora.edit',compact('confighora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $confighora)
    {
        

         $request -> validate([

            'namec'         => 'max:250|:configs,namec,'.$confighora->id,
            'descriptionc'  => 'max:250|:configs,descriptionc,'.$confighora->id,
            'param1'        => 'max:250|:configs,param1,'.$confighora->id,
            'param2'        => 'max:250|:configs,param2,'.$confighora->id,
            'param3'        => 'max:250|:configs,param3,'.$confighora->id,
            'param4'        => 'max:250|:configs,param4,'.$confighora->id,
            'param5'        => 'max:250|:configs,param5,'.$confighora->id
          

        ]);
  

        $confighora->update($request->all());
          

        //  dump($request);
        return  redirect()->route('confighora.index')->with('status_success','Hora Actualizada Exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $config = Config::find($id);
        $config->active='0';
        $config->update();

        return  redirect()->route('confighora.index')->with('status_success','Hora Eliminada Existosamente');


    }
}
