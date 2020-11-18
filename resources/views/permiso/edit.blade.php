@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Dar Permiso') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                <form action="{{route('permiso.update', $permiso->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                             
                                <label for="user_id" class="col-form-label text-md-right">{{ __('Nombre y Apellido') }}
                                </label>

                                <select class="form-control" name="user_id" id="user_id">

                                     @foreach($users as $user)

                                     <option value="{{ $user->id }}"
                                      @isset ($permiso->user[0]->name)
                                      @if ($user->name == $permiso->user[0]->name)
                                      selected 
                                      @endif
                                      @endisset


                                      >{{ $user->name }} - {{ $user->fname}}</option>

                                      @endforeach

                                </select> 

                        </div>

                        <div class="form-group">
                             
                              <label for="permittype_id" class="col-form-label text-md-right">{{ __('Tipo De Permiso') }}
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

                          <div class="form-group">

                              <label for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                             <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description')}}</textarea>

                          </div>
                                      
                              @foreach($permiestado as $permistado)
                              @endforeach
                            <div class="form-group">
                               <label for="permitstatus_id" class="col-form-label text-md-right">{{ __('Estado Permiso') }}
                              </label>
                                <select class="form-control" name="permitstatus_id" id="permitstatus_id">

                                   <option value="{{$permistado->id }}">{{ $permistado->namep}}</option>

                              </select>


                            </div>

                      </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-danger" style="margin-right: 5px" href="{{ route('permiso.index') }}">Cancelar</a>
                             <input class=" btn btn-primary" type="submit" value="Actualizar">

                    </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection