@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

{{ $date = date('Y-m-d') }}

<div class="container">
            
            @include('custom.message')
          
            @include('custom.messages')
                 
            <div class="card">
                <div class="card-header"><h2>{{ __('Lista de Almuerzos') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','almuerzo.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#almuerzos" class="btn btn-primary float-right" >Nuevo</a>

                    @endcan

                    

                    <table id="almuerzo" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Nombre</th>
                          <th scope="col">Apellido</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Menu</th>
                          <th scope="col">Acción</th>                         
                          

                        </tr>
                      </thead>
                      <tbody>
                            @foreach ($almuerzos as $almuerzo)
                              <tr>
                                  <td> {{auth()->user()->name }} </td>
                                  <td> {{auth()->user()->fname}} </td>
                                  <td>{{ $almuerzo->fecha }}</td>
                                  <td>{{ $almuerzo->description }}</td>
                                  <td>{{ $almuerzo->nombre }}</td>
                                  <!--td> 

                                   @can('haveaccess','almuerzo.show')
                                    <a class="btn btn-info" href="{{ route('almuerzo.show',$almuerzo->id) }}" >Ver</a>
                                   @endcan
                        
                                  </td-->
                                  <!--td>
                                  <a class="btn btn-success" href="">Editar</a>
                               
                                 </td-->
                                  <td> 
                                    @if ($date < $almuerzo->fecha )
                                    @can('haveaccess','almuerzo.destroy')
                                    <form action="{{ route('almuerzo.destroy',$almuerzo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                    @endcan
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
<div class="modal fade" id="almuerzos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Almuerzo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('almuerzo.store') }}" method="POST">
          @csrf
          


          <div class="row">
              <div class="col-md-12">
                <div class="form-group" hidden>
                     <label for="iduser" class="col-form-label text-md-right">{{ __('Id Usuario') }}</label>
      
                     <input id="iduser" disabled type="text" class="form-control @error('iduser') is-invaliduser @enderror" name="iduser" value="{{auth()->user()->id}}" required autocomplete="id" autofocus> 

                     @error('iduser')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>
              
            
               <div class="form-group">

                     <label for="fecha" class="col-form-label text-md-right">{{ __('fecha ') }}</label>
                     
                     <input min="{{date('Y-m-d') }}"  max="2030-12-31" id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{date('Y-m-d') }}" required autocomplete="fecha" autofocus> 

                     @error('fecha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

            
                  <div class="form-group">
                    <label for="malmuerzo_id" class="col-form-label text-md-right">{{ __('Menu Almerzo') }}
                    </label>

                    <select class="form-control" name="malmuerzo_id" id="malmuerzo_id">

                     @foreach($menualmuerzos as $malmuerzo)

                     <option value="{{ $malmuerzo->id }}"
                      @isset ($almuerzo->malmuerzo[0]->nombre)
                      @if ($malmuerzo->nombre == $almuerzo->malmuerzo[0]->nombre)
                      selected 
                      @endif
                      @endisset


                      >{{ $malmuerzo->nombre }} - {{ $malmuerzo->description }}</option>

                      @endforeach

                    </select> 

                  </div>

                    <div class="form-group">

                        <label for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                       <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description')}}</textarea>
                   </div>
                </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
          </form>
      </div>
     
    </div>
  </div>
</div>


@section('js')
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script>
  
   $('#almuerzo').DataTable({
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
@endsection