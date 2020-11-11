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
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista de Cenas') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','cena.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#cenas" class="btn btn-primary float-right" >Nueva Cena</a>

                    @endcan

                    

                    <table id="cena" class="table table-hover">
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
                            @foreach ($cenas as $cena)
                              <tr>
                                  <td> {{auth()->user()->name }} </td>
                                  <td> {{auth()->user()->fname}} </td>
                                  <td>{{ $cena->fechac }}</td>
                                  <td>{{ $cena->descriptionc }}</td>
                                  <td>{{ $cena->nombrec }}</td>
                              
                                  <td> 
                                    @if ($date < $cena->fechac )
                                    @can('haveaccess','cena.destroy')
                                    <form action="{{ route('cena.destroy',$cena->id) }}" method="POST">
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
<div class="modal fade" id="cenas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 126px;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro Cena</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <form  action="{{route('cena.store') }}" method="POST">
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
                     
                     <input min="{{date('Y-m-d') }}"  max="2030-12-31" id="fechac" type="date" class="form-control @error('fechac') is-invalid @enderror" name="fechac" value="{{date('Y-m-d') }}" required autocomplete="fechac" autofocus> 

                     @error('fechac')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

            
                  <div class="form-group">
                    <label for="menucena_id" class="col-form-label text-md-right">{{ __('Menu Cena') }}
                    </label>

                    <select disabled class="form-control" name="menucena_id" id="menucena_id">

                     @foreach($menucenas as $menucena)

                     <option value="{{ $menucena->id }}"
                      @isset ($cena->menucena[0]->nombrec)
                      @if ($menucena->nombrec == $cena->menucena[0]->nombrec)
                      selected 
                      @endif
                      @endisset


                      >{{ $menucena->nombrec }} - {{ $menucena->descriptionc }}</option>

                      @endforeach

                    </select> 

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
  
   $('#cena').DataTable({
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
