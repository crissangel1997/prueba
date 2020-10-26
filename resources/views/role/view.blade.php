@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h2>{{ __('Ver Roles') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                        <form action="{{route('role.update', $role->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                            <div class="container">
                                
                                <div class="form-group">
                                     <input type="text" class="form-control" name="name" value="{{old('name',$role->name)}}" id="name" placeholder="Nombre"  readonly >
                                </div>
                             
                               <div class="form-group">
                               
                                    <input type="text" class="form-control" value="{{ old('slug',$role->slug)}}" name="slug" id="slug"  placeholder="Slug" readonly >
                                </div>
                                                           
                                <div class="form-group">
                                  
                                    <textarea readonly class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description',$role->description)}}

                                    </textarea>
                                </div>
                                  <hr>
                                <h3>Acceso Completo</h3>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input disabled type="radio" id="full-accessyes" name="full-access" class="custom-control-input" value="yes" 

                                  @if($role['full-access']=='yes')
                                  checked
                                  @elseif(old('full-access')=='yes')
                                  checked
                                  @endif>

                                  <label class="custom-control-label" for="full-accessyes">Si</label>
                                </div>
                               

                                <div class="custom-control custom-radio custom-control-inline">
                                  <input disabled type="radio" id="full-accessno" name="full-access" class="custom-control-input" value="no"  

                                   @if($role['full-access']=='no')
                                  checked
                                  @elseif(old('full-access')=='no')
                                  checked
                                  @endif
                                 
                                  >

                                  <label class="custom-control-label" for="full-accessno">No</label>
                                </div>
                                  
                                <hr>

                                <h3>Lista De Permisos</h3>

                                @foreach($permissions as $permission)

                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox"
                                  class="custom-control-input" 
                                   id="permission_{{ $permission->id}}"
                                   value="{{ $permission->id }}"
                                   name="permission[]"
                                   disabled 

                                   @if(is_array(old('permission')) && in_array("$permission->id",old('permission')))
                                    checked 

                                    @elseif(is_array($permission_role) && in_array("$permission->id",$permission_role))
                                    checked 
                                   @endif
                                   >

                                  <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                     {{ $permission->id }}
                                     -
                                     {{ $permission->name }}

                                     <em>( {{ $permission->description }} )</em>

                                  </label>
                                </div>

                                @endforeach 
                                 <hr>
                                 <a class="btn btn-danger" href="{{ route('role.index') }}">Regresar</a>
                            </div>  
                                
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection