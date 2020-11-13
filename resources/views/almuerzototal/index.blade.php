@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

{{ $date = date('Y-m-d') }}

<div class="container">
            
            @include('custom.message')
          
            @include('custom.messages')
                 
            <div class="card card-primary card-outline">
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Almuerzos Totales') }}</h2></div>

                <div class="card-body">

                   

                   @can('haveaccess','almuerzototal.create')
                    <a href="" style="margin-top: -4px; margin-right: 10px;"  data-toggle="modal" data-target="#almtotal" class="btn btn-info float-right" >Buscar</a>

                    @endcan
                     @can('haveaccess','almuerzototal.create')
                    <a href="" data-toggle="modal" data-target="#excel" style="margin-top: -4px; margin-right: 5px;"  class="btn btn-success float-right" >Descargar Reporte</a>

                    @endcan

                    

                    <table id="almuerzototal" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Menu</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Nombre (usuario)</th>
                          <th scope="col">Apellido (usuario)</th>
                          <th scope="col">Nombre (Visita)</th>
                          <th scope="col">Apellido (Visita)</th>
                          <th scope="col">Sede</th>
                          <th scope="col">Acción</th>                         
                          

                        </tr>
                      </thead>
                      <tbody>
                            @foreach ($almuerzototal as $almuerzotot)
                              <tr>
                                  <td>{{ $almuerzotot->id }}</td>
                                  <td>{{ $almuerzotot->fecha }}</td>
                                  <td>{{ $almuerzotot->nombre }}</td>
                                  <td>{{ $almuerzotot->description }}</td>
                                  <td>{{ $almuerzotot->name }}</td>
                                  <td>{{ $almuerzotot->fname }}</td>
                                  <td>{{ $almuerzotot->namev }}</td>
                                  <td>{{ $almuerzotot->lastname }}</td>
                                  <td>{{ $almuerzotot->sede }}</td>
                              
                                 <td> 
                                   
                                    @can('haveaccess','almuerzototal.destroy')
                                    <form action="{{ route('almuerzototal.destroy',$almuerzotot->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                   @endif
                                  </td>
                              </tr>
                            @endforeach
                       </tbody>
                </table>
                  
             </div>
         </div>
    </div>

@endsection

<!-- Modal Registro Menu-->
<div class="modal fade" id="almtotal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Busqueda Por Fecha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('almuerzototal.store') }}" method="POST">
          @csrf
          
           <div class="row">
              <div class="col-md-12">

                

            
               <div class="form-group">

                     <label for="fecha1" class="col-form-label text-md-right">{{ __('Desde: ') }}</label>
                     
                     <input id="fecha1" type="date" class="form-control @error('fecha1') is-invalid @enderror" name="fecha1" value="{{date('Y-m-d') }}"  autocomplete="fecha1" autofocus> 

                     @error('fecha1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

                <div class="form-group">

                     <label for="fecha2" class="col-form-label text-md-right">{{ __('Hasta: ') }}</label>
                     
                     <input  id="fecha2" type="date" class="form-control @error('fecha2') is-invalid @enderror" name="fecha2" value="{{date('Y-m-d') }}"  autocomplete="fecha2" autofocus> 

                     @error('fecha2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

                
           </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
          </form>
      </div>
     
    </div>
  </div>
</div>

<!--expor excel------------------------------------------------------+++++++++++++++++++++++-->
<div class="modal fade" id="excel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Reporte Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{ route('almtotal.excel') }}" method="get">
          @csrf
          
           <div class="row">
              <div class="col-md-12">

                

            
               <div class="form-group">

                     <label for="fecha1" class="col-form-label text-md-right">{{ __('Desde: ') }}</label>
                     
                     <input id="fecha1" type="date" class="form-control @error('fecha1') is-invalid @enderror" name="fecha1" value="{{date('Y-m-d') }}"  autocomplete="fecha1" autofocus> 

                     @error('fecha1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

                <div class="form-group">

                     <label for="fecha2" class="col-form-label text-md-right">{{ __('Hasta: ') }}</label>
                     
                     <input  id="fecha2" type="date" class="form-control @error('fecha2') is-invalid @enderror" name="fecha2" value="{{date('Y-m-d') }}"  autocomplete="fecha2" autofocus> 

                     @error('fecha2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                 </div> 

                  <div class="form-group">

                    <label for="campo2" class="col-form-label text-md-right">{{ __('Tipo') }}
                    </label>

                      <select class="form-control" id="campo1"  name="campo1">

                        <option value="0" selected>Todos</option> 
                        <option value="1" >Usuario</option>
                        <option value="2">Visita</option>

                      </select>

                  </div>

          

             
           </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">descargar</button>
        </div>
          </form>
      </div>
     
    </div>
  </div>
</div>

@section('js')

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script>
  
   $('#almuerzototal').DataTable({
    responsive:true,
    autoWidth:false, 

     "language": {
            "lengthMenu": "Mostrar " + 
                                    '<select class="custom-select custom-select-sm form-control-sm"> <option value="10">10</option><option value="25">25 </option><option value="50">50 </option><option value="100">100 </option><option value="-1">All</option> </select>' + 
                                    " registros por paginas",
            "zeroRecords": "No se encontraron resgistros - ¡disculpa!",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate":{
            "next": "Siguiente",
            "previous": "Anterior"

            }
        }
   });




</script>


<script>

 /* $("#campo1").change(function() {
      if($("#campo1").val() !== "0"){
        $('#campo3').prop('disabled', false);
       }else{
        $('#campo3').prop('disabled', 'disabled');
       
    
      }

   
    });*/

   

 

</script>
@endsection
