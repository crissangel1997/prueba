@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

<div class="container">
            
            @include('custom.message')

            <div class="card">
                <div class="card-header"><h2>{{ __('Lista de Menu Almuerzos') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','malmuerzo.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#menualmuerzo" class="btn btn-primary float-right" >Nuevo</a>

                    @endcan

                      <table id="almuerzo" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre (Menu)</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">¿Activo?</th>
                          <th></th>
                          <th></th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>
                      
                            @foreach ($malmuerzos as $malmuerzo)
                              <tr>
                                 <th scope="row">{{ $malmuerzo->id }}</th>
                                  <td>{{ $malmuerzo->nombre }}</td>
                                  <td>{{ $malmuerzo->description }}</td>
                                  <td>
                                    @if ($malmuerzo->active == 1)
                                    SI
                                    @else
                                    NO
                                    @endif
                                  </td>
                                  <td> 

                                   @can('haveaccess','malmuerzo.show')
                                    <a class="btn btn-info" href="{{ route('malmuerzo.show',$malmuerzo->id) }}" >Ver</a>
                                   @endcan
                                  </td>
                                  <td>
                                    @can('haveaccess','malmuerzo.edit')
                                      <a class="btn btn-success" href="{{ route('malmuerzo.edit',$malmuerzo->id) }}">Editar</a>
                                    @endcan
                                 </td>
                                  <td> 
                                    @if ( $malmuerzo->active == 1)
                                    @can('haveaccess','malmuerzo.destroy')
                                    <form action="{{ route('malmuerzo.destroy',$malmuerzo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Deshabilitar</button>
                                    </form>
                                    @endcan
                                    @else
                                    @can('haveaccess','malmuerzo.destroy')
                                    <form action="{{ route('malmuerzo.destroy',$malmuerzo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary">Habilitar</button>
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
<div class="modal fade" id="menualmuerzo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Menu Almuerzo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('malmuerzo.store') }}" method="POST">
          @csrf

       <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                 <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre (Menu)') }}</label>
  
                 <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus> 
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