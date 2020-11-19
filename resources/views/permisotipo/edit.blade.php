@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Editar Tipo De Permiso') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                    <form action="{{route('permisotipo.update', $permisotipo->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                              <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="nombrept" class="col-form-label text-md-right">{{ __('Nombre del permiso') }}</label>

                                       <input id="nombrept" type="text" class="form-control @error('nombrept') is-invalid @enderror" name="nombrept" value="{{ old('nombrept', $permisotipo->nombrept) }}" required autocomplete="nombrept" autofocus> 
                                     </div>

                                     <div class="form-group">

                                      <label for="descriptionpt" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                      <textarea class="form-control"  name="descriptionpt" placeholder="Descripcion" id="descriptionpt" rows="3">{{ old('descriptionpt', $permisotipo->descriptionpt) }}</textarea>
                                    </div>
                                  </div>
                               
                           
                                 <hr>
                                <a class="btn btn-danger" style="margin-right: 5px" href="{{ route('permisotipo.index') }}">Cancelar</a>
                                <input class=" btn btn-primary" type="submit" value="Actualizar">
                                </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection