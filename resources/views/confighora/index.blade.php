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
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Configurar Hora') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','user.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#visitas" class="btn btn-primary float-right" >Nueva hora</a>

                    @endcan

                    

                    <table id="config" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Hora Inicia</th>
                          <th scope="col">Hora final</th>
                          <th scope="col">Parametro 3</th>
                          <th scope="col">Parametro 4</th>
                          <th scope="col">Parametro 5</th>
                          <th scope="col">Accion</th>
                          <th scope="col"></th>
                            

                        </tr>
                      </thead>
                      <tbody>
                            @foreach ($confighoras as $confighora)
                              <tr>
                                  <td>{{ $confighora->id}} </td>
                                  <td>{{ $confighora->namec}} </td>
                                  <td>{{ $confighora->descriptionc}}</td>
                                  <td>{{ $confighora->param1}}</td>
                                  <td>{{ $confighora->param2}}</td>
                                  <td>{{ $confighora->param3}}</td>
                                  <td>{{ $confighora->param4}}</td>
                                  <td>{{ $confighora->param5}}</td>

                               <td>
                               @can('haveaccess','user.edit')
                               <a class="btn btn-success" href="{{ route('confighora.edit',$confighora->id) }}">Editar</a>
                               @endcan
                               </td>
                                  
                               <td>
                               @can('haveaccess','user.destroy')
                                    <form action="{{ route('confighora.destroy',$confighora->id) }}" method="POST">
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
<div class="modal fade" id="visitas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Hora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('confighora.store') }}" method="POST">
          @csrf
           

          <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                   <label for="namec" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                         <input id="namec" type="text" class="form-control @error('namec') is-invalid @enderror" name="namec" value="{{ old('namec') }}" autocomplete="namec" autofocus>

                          @error('namec')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                     </div>

                    <div class="form-group">

                        <label for="descriptionc" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                       <textarea class="form-control"  name="descriptionc" placeholder="Descripcion" id="descriptionc" rows="3">{{ old('descriptionc')}}</textarea>
                    </div>

                     <div class="form-group">
                       <label for="param1" class="col-form-label text-md-right">{{ __('Hora Inicial') }}</label>

                             <input id="param1" type="time" class="form-control @error('param1') is-invalid @enderror" name="param1" value="{{ old('param1') }}" autocomplete="param1" autofocus>

                              @error('param1')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>


                     <div class="form-group">
                       <label for="param2" class="col-form-label text-md-right">{{ __('Hora Final') }}</label>

                             <input id="param2" type="time" class="form-control @error('param2') is-invalid @enderror" name="param2" value="{{ old('param2') }}" autocomplete="param2" autofocus>

                              @error('param2')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>

                           <div class="form-group">
                       <label for="param3" class="col-form-label text-md-right">{{ __('Parametro 3') }}</label>

                             <input id="param3" type="text" class="form-control @error('param3') is-invalid @enderror" name="param3" value="{{ old('param3') }}" autocomplete="param3" autofocus>

                              @error('param3')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>
                      <div class="form-group">
                       <label for="param4" class="col-form-label text-md-right">{{ __('Parametro 4') }}</label>

                             <input id="param4" type="text" class="form-control @error('param4') is-invalid @enderror" name="param4" value="{{ old('param4') }}" autocomplete="param4" autofocus>

                              @error('param4')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>

                     <div class="form-group">
                       <label for="param5" class="col-form-label text-md-right">{{ __('Parametro 5') }}</label>

                             <input id="param5" type="text" class="form-control @error('param5') is-invalid @enderror" name="param5" value="{{ old('param5') }}" autocomplete="param5" autofocus>

                              @error('param5')
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
  
   $('#config').DataTable({
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
