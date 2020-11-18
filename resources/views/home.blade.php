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
              DB::select('CALL `insLogin`(?,?,?)',$login); 
        
           @endphp  

           <div class="card-body">  



              @php
              
              $iduser2 = auth()->user()->id;     
              $login2 = [$iduser2];
              $AlmMes = DB::select('CALL `getAlmMes`(?)',$login2); 

              
              foreach ($AlmMes as $vAlmMes){
              $meses[] = $vAlmMes->MonthName ." ". $vAlmMes->Year;
              $AlmCant[] = $vAlmMes->Count;
              }

              $CenasMes = DB::select('CALL `getCenasMes`(?)',$login2); 


              
              foreach ($CenasMes as $vCenasMes){
              $mesesc[] = $vCenasMes->MonthName ." ". $vCenasMes->Year;
              $CenasCant[] = $vCenasMes->Count;
              }

              $hbd = DB::select('CALL `getHBD`()'); 
              
              setlocale(LC_TIME, "spanish");
              $mesactual = date("m");
              setlocale(LC_TIME, "spanish");
              $mesactual =   date('Y-m-d');
              $mesactual = str_replace("/", "-", $mesactual);     
              $newDate = date("d-m-Y", strtotime($mesactual));        
              $mesDesc = strftime("%B", strtotime($newDate)); 

              @endphp




              <div class="row">
                <div class="col-lg-6">
                        <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Cumpleaños de 
                            {{ $mesDesc }}
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>                  
                              <tr>
                                <th style="width: 200px">Dia</th>
                                <th style="width: 200px">Nombre</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                               @foreach ($hbd as $hbdd)
                                        <tr>
                                            <td> {{ $dd=$hbdd->DAY }} de {{ $hbdd->MONTHNAME }} </td>
                                            <td> {{ $hbdd->NAME }} 
                                            @IF($hbdd->HBD>0)
                                               <i class="fa fa-birthday-cake" aria-hidden="true" style="color:#FF0000"></i>
                                              @ENDIF
                                            </td>

                                        </tr>
                                      @endforeach

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="card"> <div class="card-header"> <h3 class="card-title">Almuerzos pedidos en los ultimos meses
                          </h3><canvas id="AlmMes"></canvas></div></div>
                      

                </div>
                <div class="col-lg-6">
                  <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">

                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                      </div>
                    <div class="card"> <div class="card-header"> <h3 class="card-title">Cenas pedidas en los ultimos meses
                          </h3><canvas id="CenasMes"></canvas></div></div>

                </div>
              </div>

             <br>
             

           </div>
      </div>
  </div>

</div> 
@stop

@section('css')
 <!--link rel="stylesheet" type="text/css" href="/css/admin_custom.css"-->
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>


 

 
@stop

