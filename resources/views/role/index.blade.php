@extends('adminlte::page')

@section('content')


@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


@endsection

<div class="container">
 
      @include('custom.message')

      <div class="card card-primary card-outline">
          <div class="card-header"><h2 style="font-family: monospace;">{{ __('Lista de Roles') }}</h2></div>

                <div class="card-body">
                    @can('haveaccess','role.create')
                    <a href="{{ route('role.create') }}" style="margin-top: -4px;" class="btn btn-primary float-right" >Crear</a>
                    @endcan

                    <table id="roles" class="table table-hover ">
                      <thead>
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Slug</th>
                          <th scope="col">Description</th>
                          <th scope="col">Active</th>
                          <th scope="col">Full-access</th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                        </tr>
                      </thead>
                      <tbody>
                      
                            @foreach ($roles as $role)
                              <tr>
                                 <th scope="row">{{ $role->id }}</th>
                                  <td>{{ $role->name }}</td>
                                  <td>{{ $role->slug }}</td>
                                  <td>{{ $role->description }}</td>
                                  <td>{{ $role->active }}</td>
                                  <td>{{ $role['full-access']}}</td>
                                  <td>
                                  @can('haveaccess','role.show')
                                   <a class="btn btn-info" href="{{ route('role.show',$role->id) }}">Ver</a>
                                   @endcan
                                 </td>
                                  <td>
                                   @can('haveaccess','role.edit')
                                   <a class="btn btn-success" href="{{ route('role.edit',$role->id) }}">Editar</a>
                                   @endcan
                                   </td>


                                  <td> 
                                    @can('haveaccess','role.destroy')
                                    <form action="{{ route('role.destroy',$role->id) }}" method="POST">
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
  
   $('#roles').DataTable({
    responsive:true,
    autoWidth:false,
      "language": {
      "lengthMenu": "Mostrar " + '<select class="custom-select custom-select-sm form-control-sm"> <option value="10">10</option><option value="25">25 </option><option value="50">50 </option><option value="100">100 </option><option value="-1">All</option> </select>' + " registros por paginas",
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