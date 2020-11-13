@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Editar Hora') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')
                      
                     <form  action="{{route('confighora.update',$confighora->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                             <label for="namec" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                                   <input id="namec" type="text" class="form-control @error('namec') is-invalid @enderror" name="namec" value="{{ old('namec', $confighora->namec) }}" autocomplete="namec" autofocus>

                                    @error('namec')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>

                              <div class="form-group">

                                  <label for="descriptionc" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                 <textarea class="form-control"  name="descriptionc" placeholder="Descripcion" id="descriptionc" rows="3">{{ old('descriptionc', $confighora->descriptionc )}}</textarea>
                              </div>

                               <div class="form-group">
                                 <label for="param1" class="col-form-label text-md-right">{{ __('Hora Inicial') }}</label>

                                       <input id="param1" type="time" class="form-control @error('param1') is-invalid @enderror" name="param1" value="{{ old('param1',$confighora->param1) }}" autocomplete="param1" autofocus>

                                        @error('param1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                 </div>


                               <div class="form-group">
                                 <label for="param2" class="col-form-label text-md-right">{{ __('Hora Final') }}</label>

                                       <input id="param2" type="time" class="form-control @error('param2') is-invalid @enderror" name="param2" value="{{ old('param2',$confighora->param2) }}" autocomplete="param2" autofocus>

                                        @error('param2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                 </div>

                                     <div class="form-group">
                                 <label for="param3" class="col-form-label text-md-right">{{ __('Parametro 3') }}</label>

                                       <input id="param3" type="text" class="form-control @error('param3') is-invalid @enderror" name="param3" value="{{ old('param3',$confighora->param3) }}" autocomplete="param3" autofocus>

                                        @error('param3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                 </div>
                                <div class="form-group">
                                 <label for="param4" class="col-form-label text-md-right">{{ __('Parametro 4') }}</label>

                                       <input id="param4" type="text" class="form-control @error('param4') is-invalid @enderror" name="param4" value="{{ old('param4',$confighora->param4) }}" autocomplete="param4" autofocus>

                                        @error('param4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                 </div>

                               <div class="form-group">
                                 <label for="param5" class="col-form-label text-md-right">{{ __('Parametro 5') }}</label>

                                       <input id="param5" type="text" class="form-control @error('param5') is-invalid @enderror" name="param5" value="{{ old('param5',$confighora->param5) }}" autocomplete="param5" autofocus>

                                        @error('param5')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                 </div>

                            </div>
                    </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </div>
                    </form>
                          

                </div>
            </div>
        </div>
    </div>
</div>
@endsection