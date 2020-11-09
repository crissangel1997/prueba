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
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Visita') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','visita.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#visitas" class="btn btn-primary float-right" >Nueva Visita</a>

                    @endcan

                    

                    <table id="visit" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Apellido</th>
                          <th scope="col">¿Activo?</th>
                          <th scope="col">Acción</th>                         
                          

                        </tr>
                      </thead>
                      <tbody>
                            @foreach ($visitas as $visita)
                              <tr>
                                  <td>{{$visita->id}} </td>
                                  <td>{{ $visita->namev}} </td>
                                  <td>{{ $visita->lastname}}</td>
                                  <td>
                                  @if ($visita->active == 1)
                                  SI
                                  @else
                                  NO
                                  @endif
                                  </td> 

                                <td> 

                                  @if ($visita->active == 1)
                                    @can('haveaccess','visita.destroy')
                                    <form action="{{ route('visita.destroy',$visita->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Deshabilitar</button>
                                    </form>
                                    @endcan
                                    @else
                                    @can('haveaccess','visita.edit')
                                    <form action="{{ route('visita.edit',$visita->id) }}" method="get">
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
<div class="modal fade" id="visitas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Visita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('visita.store') }}" method="POST">
          @csrf
           

          <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                   <label for="name" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                     </div>

                     <div class="form-group">
                       <label for="lastname" class="col-form-label text-md-right">{{ __('Apellido') }}</label>

                             <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                              @error('lastname')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
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
  
   $('#visit').DataTable({
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
