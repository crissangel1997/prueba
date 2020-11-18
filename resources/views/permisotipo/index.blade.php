@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

<div class="container">
           @include('custom.message')
            <div class="card card-primary card-outline">
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista Tipo Permisos') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','permisotipo.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#permsiot" class="btn btn-primary float-right" >Nuevo Tipo Permiso</a>

                    @endcan

                      <table id="permisotipo" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Active</th>
                          <th scope="col"></th>
                          <th></th>
                      
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach ($permisotipo as $permisot)
                          <tr>
                              <th scope="row">{{ $permisot->id }}</th>
                                  <td>{{ $permisot->nombrept }}</td>
                                  <td>{{ $permisot->descriptionpt }}</td>
                                  <td> {{ $permisot->active }}</td>
                                  <td>
                                    @can('haveaccess','permisotipo.edit')
                                      <a class="btn btn-success" href="{{ route('permisotipo.edit',$permisot->id) }}">Editar</a>
                                    @endcan
                                 </td>

                                  <td> 
                                   @can('haveaccess','permisotipo.destroy')
                                    <form action="{{ route('permisotipo.destroy',$permisot->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Elminar</button>
                                    </form>
                                    @endcan

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
<div class="modal fade" id="permsiot" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('permisotipo.store') }}" method="POST">
          @csrf

       <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                 <label for="nombrept" class="col-form-label text-md-right">{{ __('Nombre ') }}</label>
  
                 <input id="nombrept" type="text" class="form-control @error('nombrept') is-invalid @enderror" name="nombrept" value="{{ old('nombrept') }}" required autocomplete="nombrept" autofocus> 
            </div>

            <div class="form-group">

                <label for="descriptionpt" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
               <textarea class="form-control"  name="descriptionpt" placeholder="Descripcion" id="descriptionpt" rows="3">{{ old('descriptionpt')}}</textarea>

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
  
   $('#permisotipo').DataTable({
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