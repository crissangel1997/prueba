<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Permission\Models\MenuAlmuerzo;
use App\Permission\Models\MenuCena;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use DB;

class MenuCenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
     
        Gate::authorize('haveaccess','menucena.index');
     
        $mcenas = DB::select('CALL `getmenuCena`()');


    // dump($mcena);
    
     return view('menucena.index',compact('mcenas'));
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
       $mcenas = [$request->nombrec, $request->descriptionc];
       DB::select('CALL `insMenuCena`(?,?)',$mcenas);
     
     

     return  redirect()->route('menucena.index')->with('status_success','Menu cena  guardado Existosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menucena $menucena)
    {
        
        $this->authorize('haveaccess','menucena.show');

       
        return view('menucena.view',compact('menucena'));

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuCena $menucena)
    {
        
        $this->authorize('haveaccess','menucena.edit');

      
        return view('menucena.edit',compact('menucena'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuCena $menucena)
    {
         $request -> validate([

            'nombrec'       => 'required|max:150|:menu_cenas,nombrec,'.$menucena->id,
            'descriptionc'  => 'required|max:150|:menu_cenas,descriptionc,'.$menucena->id

        ]);
  
        $menucena->update($request->all());
          // $menucena = DB::select('sp_UdateMenualmuerzo (?,?)',[$request->nombre, $request->description ]);
          //dump($menucena);
        return  redirect()->route('menucena.index')->with('status_success','Menu Cena Actualizado Existosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuCena $menucena)
    {
        $this->authorize('haveaccess','menucena.destroy');

        
        $id = [$menucena->id];
         //dump ($id);
      DB:: select ('CALL `updActiveMenu`(?)',$id);

    
       return  redirect()->route('menucena.index')->with('status_success','Menu Cena Actualizado Existosamente');
    }
}
