@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h2>{{ __('Ver Menu Cena') }}</h2></div>

                  <div class="card-body">

                    @include('custom.message')

                    
                        <form action="{{route('menucena.show', $menucena->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                            <div class="row">
                              <div class="col-md-12">
                                   
                                <div class="form-group">
                                     <label for="nombrec" class="col-form-label text-md-right">{{ __('Nombre (Menu)') }}</label>

                                     <input   id="nombrec" type="text" class="form-control @error('nombrec') is-invalid @enderror" name="nombrec" value="{{ old('nombrec', $menucena->nombrec) }}" required autocomplete="nombrec" autofocus> 
                                </div>

                                <div class="form-group">

                                    <label for="descriptionc" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                    <textarea   class="form-control"  name="descriptionc" placeholder="Descripcion" id="descriptionc" rows="3">{{ old('descriptionc', $menucena->descriptionc)}}</textarea>
                                </div>  
                              </div>
                                 <hr>
                                <a class="btn btn-danger" style="margin-right: 5px" href="{{ route('menucena.index') }}">Cancelar</a>
                                <input class=" btn btn-primary" type="submit" value="Actualizar">
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection