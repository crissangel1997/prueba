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
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use DB;

class AlmuerzoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        Gate::authorize('haveaccess','almuerzo.index');
        $iduser = auth()->user()->id;
        $almuerzos = DB::select('CALL ` getAlmuerzo`(?)',[$iduser]);

        $menualmuerzos = DB::select('CALL `getSelectMenuAlmuerzo`()');

         $visitas = DB::select('CALL `getSelectVisita`()');
        return view('almuerzo.index',compact('almuerzos','menualmuerzos', 'visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        
    $visita = [$request->visit_id,  $request->fecha, $request->malmuerzo_id, $request->description];

    //dump($visita);
       DB::select('CALL `insAlmuerzoVisita`(?,?,?,?)',$visita);

    return  redirect()->route('almuerzo.index')->with('status_success','¡la visita  ha pedido su almuerzo!');



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

        $iduser = auth()->user()->id;

        $ValidateAlm = [$iduser,  $request->fecha];
        $almuerzos = [$iduser,  $request->fecha, $request->malmuerzo_id, $request->description];
        $ValAlm = DB::select('CALL `getValidateAlm`(?,?)',$ValidateAlm);
       
 
     
        $date = date('Y-m-d');
    
        
        if ($ValAlm == null)  {

            DB::select('CALL `insAlmuerzo`(?,?,?,?)',$almuerzos);

            return  redirect()->route('almuerzo.index')->with('status_success','¡El usuario '.auth()->user()->name.'  '.auth()->user()->fname.'  ha pedido su almuerzo!');


         }else{

            return  redirect()->route('almuerzo.index')->with('warning','¡El usuario '.auth()->user()->name.'  '.auth()->user()->fname.' ya tiene su almuerzo!');
      
         }


     
    


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Almuerzo $almuerzo)
    {
       /* $this->authorize('haveaccess','almuerzo.show');

         $malmuerzos = MenuAlmuerzo::orderBy('nombre')->get();

   
        return view('almuerzo.view',compact('malmuerzos', 'almuerzo'));*/
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
        public function destroy(Almuerzo $almuerzo)
        {
      
       $this->authorize('haveaccess','almuerzo.destroy');

        $almuerzo->active='0';
        $almuerzo->update();

        return  redirect()->route('almuerzo.index')->with('status_success','Almuerzo Eliminado Existosamente');

    }
   



 
    
}
