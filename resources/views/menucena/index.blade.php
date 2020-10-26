@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

<div class="container">
           @include('custom.message')
            <div class="card">
                <div class="card-header"><h2>{{ __('Lista de Menu Cena') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','menucena.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#menucena" class="btn btn-primary float-right" >Nuevo</a>

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
                      
                        @foreach ($mcenas as $mcena)
                          <tr>
                              <th scope="row">{{ $mcena->id }}</th>
                                  <td>{{ $mcena->nombrec }}</td>
                                  <td>{{ $mcena->descriptionc }}</td>
                                  <td>
                                  @if ($mcena->active == 1)
                                  SI
                                  @else
                                  NO
                                  @endif
                                  </td> 
                                  <td> 

                                  @can('haveaccess','menucena.show')
                                    <a class="btn btn-info" href="{{ route('menucena.show',$mcena->id) }}" >Ver</a>
                                  @endcan
                                  </td>
                                  <td>
                                    @can('haveaccess','menucena.edit')
                                      <a class="btn btn-success" href="{{ route('menucena.edit',$mcena->id) }}">Editar</a>
                                    @endcan
                                 </td>


                                  <td> 

                                  @if ( $mcena->active == 1)
                                    @can('haveaccess','menucena.destroy')
                                    <form action="{{ route('menucena.destroy',$mcena->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Deshabilitar</button>
                                    </form>
                                    @endcan
                                    @else
                                    @can('haveaccess','menucena.destroy')
                                    <form action="{{ route('menucena.destroy',$mcena->id) }}" method="POST">
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
<div class="modal fade" id="menucena" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Menu Cena</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('menucena.store') }}" method="POST">
          @csrf

       <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                 <label for="nombrec" class="col-form-label text-md-right">{{ __('Nombre (Menu)') }}</label>
  
                 <input id="nombrec" type="text" class="form-control @error('nombrec') is-invalid @enderror" name="nombrec" value="{{ old('nombrec') }}" required autocomplete="nombrec" autofocus> 
            </div>

            <div class="form-group">

                <label for="descriptionc" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
               <textarea class="form-control"  name="descriptionc" placeholder="Descripcion" id="descriptionc" rows="3">{{ old('descriptionc')}}</textarea>

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