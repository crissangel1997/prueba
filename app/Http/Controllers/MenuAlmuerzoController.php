<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Permission\Models\MenuAlmuerzo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use DB;

class MenuAlmuerzoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  

        Gate::authorize('haveaccess','menualmuerzo.index');
         
         $malmuerzos = DB::select(' CALL `getMenuAlmuerzo`()');
        
        return view('menualmuerzo.index',compact('malmuerzos'));
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
    
  
       $this->authorize('haveaccess','malmuerzo.create');
       /*inserta datos con procedimientos almacenados */
       $malmuerzos = [$request->nombre, $request->description];
       DB::select('CALL insMenuAlmuerzo  (?,?)',$malmuerzos);

       //dump($malmuerzos);
       return  redirect()->route('malmuerzo.index')->with('status_success','Menu guardado Existosamente');

     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MenuAlmuerzo $malmuerzo)
    {   
        $this->authorize('haveaccess','malmuerzo.show');

      
        return view('menualmuerzo.view',compact('malmuerzo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuAlmuerzo $malmuerzo)
    {
        
        $this->authorize('haveaccess','malmuerzo.edit');
        return view('menualmuerzo.edit',compact('malmuerzo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuAlmuerzo $malmuerzo)
    {
        
        $request -> validate([

            'nombre'      => 'required|max:150|:users,name,'.$malmuerzo->id,
            'description'  => 'required|max:150|:users,sname,'.$malmuerzo->id

        ]);
  
        $malmuerzo->update($request->all());
          
        return  redirect()->route('malmuerzo.index')->with('status_success','Menu Actualizado Existosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuAlmuerzo $malmuerzo)
    {
      
        $this->authorize('haveaccess','malmuerzo.destroy');
     
        $id = [$malmuerzo->id];
   
        DB:: select ('CALL `updActiveMenuAlm`(?)',$id);

        return  redirect()->route('malmuerzo.index')->with('status_success','Menu Actualizado Existosamente');
    }
}
