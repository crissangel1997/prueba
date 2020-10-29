@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Crear Roles') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                        <form action="{{route('role.store') }}" method="POST">
                          @csrf
                            <div class="container">
                                
                                <div class="form-group">
                                     <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Nombre">
                                </div>
                             
                               <div class="form-group">
                               
                                    <input type="text" class="form-control" value="{{ old('slug')}}" name="slug" id="slug"  placeholder="Slug">
                                </div>
                                                           
                                <div class="form-group">
                                  
                                    <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description')}}

                                    </textarea>
                                </div>
                                  <hr>
                                <h3>Acceso Completo</h3>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="full-accessyes" name="full-access" class="custom-control-input" value="yes" 

                                  @if(old('full-access')=='yes')
                                  checked 
                                  @endif>

                                  <label class="custom-control-label" for="full-accessyes">Si</label>
                                </div>
                               

                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="full-accessno" name="full-access" class="custom-control-input" value="no"  

                                  @if(old('full-access')=='no')
                                  checked 
                                  @endif

                                    @if(old('full-access')===null)
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

                                   @if(is_array(old('permission')) && in_array("permission->id",old('permission')))
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
                                 <input class=" btn btn-primary" type="submit" value="Guardar">
                            </div>  
                                
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection