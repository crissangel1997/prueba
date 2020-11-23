<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Permission\Models\Permits;
use App\Permission\Models\Attachment;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request, Permits $permiso)
    {
        
        $this->authorize('haveaccess','permisotipo.create');

        $permiso = [$request->fechainicio, $request->fechafinal, $request->horainicio, $request->horafinal, $request->user_id, $request->permittype_id, $request->description, $request->permitstatus_id];

         

        $request->validate([
          
            'file' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
        
 
          ]);
    

          DB::select('CALL `insPermiso`(?,?,?,?,?,?,?,?)',$permiso); 

          $idpt = Permits::latest()->first()->id;

            $archivos = $request->file('file')->store('public/archivos');
               
            $size = Storage::size($archivos);
            $mimetype = Storage::mimetype($archivos);
            $url = Storage::url($archivos);
        
            $permi = [$idpt, $size, $mimetype, $url];

          
            DB::select('CALL `insPermiFile`(?,?,?,?)',$permi);



        return  redirect()->route('permiso.index')->with('status_success','Permiso Registrado Exitosamente') ;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      

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
          

        $id = [$permiso->id];
     
            
         $permilist = DB::select('CALL `getPermisoFrom`(?)',$id);

         //dump($permilist);
      
        return view('permiso.edit',compact('permiso','permilist','permisotipo','permiestado'));
    


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

          $id = [$permiso->id]; 
          
          $iduser = auth()->user()->id;
          $permitstatus=intval($request->permitstatus_id);

            $permiso = [$permitstatus ,  $iduser,  $id[0]];

        //dump($permiso);

         DB::select('CALL updPermiso (?,?,?)',$permiso);


      return  redirect()->route('permiso.index')->with('status_success','Permiso Actualizado Existosamente');
       
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


    public function download($id){

        $dl = Attachment::find($id);

     //dump($dl);

      return Storage::download($dl->url, $dl->mimetype);

      
    }
}
