@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

<div class="container">
           @include('custom.message')
            <div class="card card-primary card-outline">
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista  pedir un permiso') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','permisouser.create')
                    <a href="" style="margin-top: -4px;"  data-toggle="modal" data-target="#permsiouser" class="btn btn-primary float-right" >Nuevo Permiso</a>

                    @endcan

                      <table id="permiu" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Fecha inicio</th>
                          <th scope="col">Fecha final</th>
                          <th scope="col">Hora inicio</th>
                          <th scope="col">Fecha final</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Apellido</th>
                          <th scope="col">Tipo permiso</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Estado permiso</th>
                          <th scope="col">Aprobado por: </th>
                          <th scope="col">Active</th>
                          <th scope="col"></th>
            
                      
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach ($permisouser as $permiuser)
                          <tr>
                              <th scope="row">{{ $permiuser->id }}</th>

                                  <td>{{ $permiuser->fechainicio }}</td>
                                  <td>{{ $permiuser->fechafinal }}</td>
                                  <td>{{ $permiuser->horainicio }}</td>
                                  <td>{{ $permiuser->horafinal }}</td>
                                  <td>{{ $permiuser->name }}</td>
                                  <td>{{ $permiuser->fname }}</td>
                                  <td>{{ $permiuser->nombrept }}</td>
                                  <td>{{ $permiuser->description }}</td>
                                  <td>{{ $permiuser->namep }}</td>
                                  <td>{{ $permiuser->nombre}} --- {{$permiuser->apellido}} </td>
                                  <td>{{ $permiuser->active }}</td>
                                
                                 <td> 
                                   @can('haveaccess','permisouser.destroy')
                                    <form action="{{ route('permisouser.destroy',$permiuser->id) }}" method="POST">
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
<div class="modal fade" id="permsiouser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top: 126px; width: 106%;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro pedir permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form  action="{{route('permisouser.store') }}" name="form" method="POST">
          @csrf

       <div class="row">
          <div class="col-md-6">

            <div class="form-group">
                   <label for="fechainicio" class="col-form-label text-md-right">{{ __('Fecha inicial permiso') }}</label>

                         <input id="fechainicio" type="date" class="form-control @error('fechainicio') is-invalid @enderror" name="fechainicio" value="{{ old('fechainicio') }}" autocomplete="fechainicio" required autofocus>

                          @error('fechainicio')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                  </div>
             </div>

                <div class="col-md-6">
                     <div class="form-group">

                       <label for="fechafinal" class="col-form-label text-md-right">{{ __('Fecha final permiso') }}</label>

                             <input id="fechafinal" type="date" class="form-control @error('fechafinal') is-invalid @enderror" name="fechafinal" value="{{ old('fechafinal') }}" autocomplete="fechafinal" required autofocus>

                              @error('fechafinal')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>
                   </div>
              
            </div>



          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                 <label  for="permittype_id" class="col-form-label text-md-right">{{ __('Habilite los campos de horas si las fechas de permiso son el mismo dia') }}
                    </label>

                      <input type="checkbox"    name="check" id="check"  onclick="funcion()" />
                 

               
                  </div>
              </div>
            </div>


          <div class="row" style="margin-top: -14px;">
          <div class="col-md-6">

               <div class="form-group">
                   <label for="horainicio" class="col-form-label text-md-right">{{ __('Hora inicial permiso') }}</label>

                         <input id="horainicio"  disabled  type="time" class="form-control @error('horainicio') is-invalid @enderror" name="horainicio" value="{{ old('horainicio') }}" autocomplete="horainicio" autofocus>

                          @error('horainicio')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                  </div>
                </div>

              <div class="col-md-6">
                     <div class="form-group">
                       <label for="horafinal" class="col-form-label text-md-right">{{ __('Hora final permiso') }}</label>

                             <input id="horafinal" disabled type="time" class="form-control @error('horafinal') is-invalid @enderror" name="horafinal" value="{{ old('horafinal') }}" autocomplete="horafinal" autofocus>

                              @error('horafinal')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                       </div>
                  </div>
             </div>
        <div class="row">
          

          <div class="col-md-12">
              <div class="form-group">
                   
                    <label for="permittype_id" class="col-form-label text-md-right">{{ __('Tipo de permiso') }}
                    </label>

                    <select class="form-control" name="permittype_id" id="permittype_id">

                     @foreach($permisotipo as $permisotip)

                     <option value="{{ $permisotip->id }}"
                      @isset ($permiso->permisotip[0]->nombrept)
                      @if ($permisotip->nombrept == $permiso->permisotip[0]->nombrept)
                      selected 
                      @endif
                      @endisset


                      >{{ $permisotip->nombrept}}</option>

                      @endforeach

                    </select> 

                </div>
              </div>
           </div>   
     
        <div class="row">
            <div class="col-md-12">
            <div class="form-group">

                <label for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
               <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description')}}</textarea>

            </div>
              
              @foreach($permiestado as $permistado)
              @endforeach
            <div class="form-group">
               <label for="permitstatus_id" class="col-form-label text-md-right">{{ __('Estado permiso') }}
              </label>
                <select class="form-control" name="permitstatus_id" id="permitstatus_id">

                   <option value="{{$permistado->id }}">{{ $permistado->namep}}</option>

              </select>


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
  
   $('#permiu').DataTable({
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



function funcion(){
     if(document.form.check.checked == true){
        document.form.horainicio.disabled = false;
        document.form.horafinal.disabled = false;
        
  }  else{
        document.form.horainicio.disabled = true;
        document.form.horafinal.disabled = true;
  
    }
}





</script>

@endsection