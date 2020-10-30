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
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista Almuerzo Visita') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','visita.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#visitas" class="btn btn-primary float-right" >Nueva Visita</a>

                    @endcan

                    

                    <table id="visita" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Apellido</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Menu</th>
                           <th scope="col">activo</th>
                          <th scope="col">Acción</th>                         
                          

                        </tr>
                      </thead>
                      <tbody>
                            @foreach ($visitas as $visita)
                              <tr>
                                  <td>{{ $visita->id    }} </td>
                                  <td>{{ $visita->name  }} </td>
                                  <td>{{ $visita->fname  }} </td>
                                  <td>{{ $visita->fechav }}</td>
                                  <td>{{ $visita->descriptionv }}</td>
                                  <td>{{ $visita->nombre }}</td>
                                  <td>{{ $visita->activev }}</td>


                                  
                                  <td> 
                                    @if ($date < $visita->fechav )
                                    @can('haveaccess','visita.destroy')
                                    @csrf
                                    @method('DELETE')
                                      <a class="btn btn-danger" href="{{route('visita.destroy',$visita->id) }}">Eliminar</a>
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
                    <label for="user_id" class="col-form-label text-md-right">{{ __('Nombre y  Apellido') }}
                    </label>

                    <select class="form-control" name="user_id" id="user_id">

                     @foreach($users as $user)

                     <option value="{{ $user->id }}"
                      @isset ($visita->user[0]->name)
                      @if ($user->name == $visita->user[0]->name)
                      selected 
                      @endif
                      @endisset


                      >{{ $user->name }} - {{ $user->fname }}</option>

                      @endforeach

                    </select> 

              </div>
                
              
            
               <div class="form-group">

                     <label for="fechav" class="col-form-label text-md-right">{{ __('fecha') }}</label>
                     
                     <input min="{{date('Y-m-d') }}"  max="2030-12-31" id="fechav" type="date" class="form-control @error('fechav') is-invalid @enderror" name="fechav" value="{{date('Y-m-d') }}" required autocomplete="fechav" autofocus> 

                     @error('fechav')
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

                        <label for="descriptionv" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                       <textarea class="form-control"  name="descriptionv" placeholder="Descripcion" id="descriptionv" rows="3">{{ old('descriptionv')}}</textarea>
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
  
   $('#visita').DataTable({
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
