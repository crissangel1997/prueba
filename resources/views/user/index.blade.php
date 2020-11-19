@extends('adminlte::page')


@section('content')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection
<div class="container">
    
           @include('custom.message')
            <div class="card card-primary card-outline">
                <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista de usuarios') }}</h2></div>

                <div class="card-body">

                   @can('haveaccess','user.create')
                    <a href="{{ route('user.create') }}" style="margin-top: -4px;" class="btn btn-primary float-right" >Crear</a>

                    @endcan

                     <table id="usuario" class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombres</th>
                          <th scope="col">Apellidos</th>
                          <th scope="col">Tip.Identificacion</th>
                          <th scope="col">Identificacion</th>
                          <th scope="col">Usuario</th>
                          <th scope="col">Rol</th>
                          <th scope="col">Active</th>
                          <th></th>
                          <th></th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>
                      
                            @foreach ($users as $user)
                              <tr>
                                 <th scope="row">{{ $user->id }}</th>
                                  <td>{{ $user->name }}-{{ $user->sname }}</td>
                                  <td>{{ $user->fname }}-{{ $user->slname }}</td>
                                  <td>{{ $user->typeident }}</td>
                                  <td>{{ $user->ident }}</td>
                                  <td>{{ $user->usu }}</td>
                                    <td>
                                  @isset($user->roles[0]->name)
                                     {{$user->roles[0]->name }}</td>
                                  @endisset
                                  <td>{{ $user->active }}</td>
                                  

                                  <td> 
                                   @can('view', [$user, ['user.show','userown.show']])
                                    <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Ver</a>
                                   @endcan
                                  </td>
                                  <td>

                                   @can('view', [$user, ['user.edit','userown.edit']])
                                   <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}">Editar</a>
                                   @endcan
                                 </td>


                                  <td> 
                                    @can('haveaccess','user.destroy')
                                    <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Eliminar</button>
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
@section('js')
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script>
  
   $('#usuario').DataTable({
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
