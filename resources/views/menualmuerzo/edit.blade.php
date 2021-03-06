@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Editar Menu Almuerzo') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                        <form action="{{route('malmuerzo.update', $malmuerzo->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                              <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre (Menu)') }}</label>

                                       <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $malmuerzo->nombre) }}" required autocomplete="nombre" autofocus> 
                                     </div>

                                     <div class="form-group">

                                      <label for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                      <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description', $malmuerzo->description) }}</textarea>
                                    </div>
                                  </div>
                               
                           
                                 <hr>
                                <a class="btn btn-danger" style="margin-right: 5px" href="{{ route('malmuerzo.index') }}">Cancelar</a>
                                <input class=" btn btn-primary" type="submit" value="Actualizar">
                                </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection