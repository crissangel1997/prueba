@extends('adminlte::page')

  
@section('content_header')
  <h1>ContacSer</h1>

@stop

@section('content')
   <div class="row"> 
      <div class="col-md-12">    
       <div class="card">        
            <div class="card-header">  
                <h1 class="car-title">Bienvenido </h1>

           </div>


           <div class="card-body">  

              Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Non vel labore animi ratione consectetur quod obcaecati vitae laborum harum ad accusamus aperiam, consequuntur? Atque velit voluptates dolores, amet, illo nam.  
              <p>inicio de sesión actual {{ auth()->user()->current_sign_in_at}}</p>
              <p>último inicio de sesión  {{ auth()->user()->last_sign_in_at}}</p>

             <p>Nombre de usuario del pc {{ auth()->user()->host_name}}</p>

             <p>@php
             /*echo 'Current script owner: ' . get_current_user();
               echo gethostname();

               echo $_SERVER['HTTP_USER_AGENT']*/
                      
  
              @endphp </p>
            
         

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

