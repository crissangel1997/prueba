@extends('adminlte::page')

  
@section('content_header')
  <h1>ContacSer</h1>

@stop

@section('content')
@csrf
   <div class="row"> 
      <div class="col-md-12">    
       <div class="card card-primary card-outline">        
            <div class="card-header">  
                <h1 class="car-title">Bienvenido </h1>

           </div>
           @php
             
              $iduser = auth()->user()->id;     
              $login = [$iduser,  gethostname(), $_SERVER['REMOTE_ADDR']];
              //dump ($login);
             DB::select('CALL `insLogin`(?,?,?)',$login); 
        
           @endphp  

           <div class="card-body">  

              Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Non vel labore animi ratione consectetur quod obcaecati vitae laborum harum ad accusamus aperiam, consequuntur? Atque velit voluptates dolores, amet, illo nam.  
            
         

           </div>
      </div>
  </div>

</div> 
@stop

@section('css')
 <!--link rel="stylesheet" type="text/css" href="/css/admin_custom.css"-->
@stop

@section('js')
  
    <script >
      
    
    </script>
@stop

