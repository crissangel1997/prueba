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
use App\User;
use Illuminate\Support\Facades\Storage;
use DB; 


class PermitsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Gate::authorize('haveaccess','permisouser.index');
        $iduser = auth()->user()->id;

        $permisouser = DB::select('CALL `getPermisoUser`(?)',[$iduser]);
        $users = DB::select('CALL `getSelectUsers`()');
        $permisotipo = DB::select('CALL ` getPermirsotipo`()');
        $permiestado  = DB::select('CALL `getPermitStatus`()');
          $sd = DB::select('CALL `getSedel`(?)',[$iduser]);
        //dump($permisouser);

        return view('permisouser.index',compact('permisouser','users', 'permisotipo','permiestado','sd'));
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
         
        $this->authorize('haveaccess','permisouser.create');

        $iduser = auth()->user()->id;
       

       $permisouser = [$request->fechainicio, $request->fechafinal, $request->horainicio, $request->horafinal, $iduser, $request->permittype_id, $request->description, $request->permitstatus_id,$request->sede];



$request->validate([
          
            'file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
        
 
     ]);
    

      DB::select('CALL `insPermisoUser`(?,?,?,?,?,?,?,?,?)',$permisouser);


    $idp = Permits::latest()->first()->id;
  


if ($request->file('file') == null) {
  
        $idnl = [$idp, null, null, null];
     DB::select('CALL `insAttachment`(?,?,?,?)',$idnl);

}else{

  
      $archivo = $request->file('file')->store('public/archivos');
     //dd($idp);

      $size = Storage::size($archivo);
      $mimetype = Storage::mimetype($archivo);
      $url = Storage::url($archivo);
    
      $Attachment = [$idp, $size, $mimetype, $url];
    

      //dd($Attachment);
       DB::select('CALL `insAttachment`(?,?,?,?)',$Attachment);

   //insNullAttchment
}
     // return $idp.$size.$mimetype.$url;
    
    

   return  redirect()->route('permisouser.index')->with('status_success','Permiso Registrado Exitosamente');


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
    public function destroy(Permits $permisouser)
    {


      $this->authorize('haveaccess','permisouser.destroy');

        $permisouser->active='0';
        $permisouser->update();

        return  redirect()->route('permisouser.index')->with('status_success','Registro Eliminado Existosamente');
    }
}
