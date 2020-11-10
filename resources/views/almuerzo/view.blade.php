@extends('adminlte::page')

@section('content ')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Ver  Almuerzo') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                        <form action="{{route('almuerzo.show', $almuerzo->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                              <div class="row">
                                 <div class="col-md-12">
                      
                                  
                              
                            
                               <div class="form-group">

                                     <label for="fecha" class="col-form-label text-md-right">{{ __('fecha ') }}</label>
                                     
                                     <input min="{{date('Y-m-d') }}"  max="2030-12-31" id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha',$almuerzo->fecha) }}" required autocomplete="fecha" autofocus> 

                                     @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                </div>

                            
                                  <div class="form-group">
                                    <label for="malmuerzo_id" class="col-form-label text-md-right">{{ __('Menu') }}
                                    </label>

                                      <select  class="form-control" name="malmuerzo_id" id="malmuerzo_id">

                                          @foreach($malmuerzos as $malmuerzo)
                                            
                                             <option value="{{ $malmuerzo->id }}"
                                              @isset ($almuerzo->malmuerzo[0]->nombre)
                                                     @if ($malmuerzo->nombre == $almuerzo->malmuerzo[0]->nombre)
                                                   selected 
                                                  @endif
                                              @endisset
                                               >{{ $malmuerzo->nombre }}</option>

                                          @endforeach

                                          

                                         </select> 
                                     </div>

                                    <div class="form-group">

                                        <label for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                       <textarea class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description', $almuerzo->description)}}</textarea>
                                   </div>
                                </div>
                        </div>
                           
                                 <hr>
                                 <a class="btn btn-danger" href="{{ route('almuerzo.index') }}">Regresar</a>
                                </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!--div class="form-group">
                
                     
                    <label for="visit_id" class="col-form-label text-md-right">{{ __('Usuarios') }}
                    </label>

                    <select class="form-control" name="visit_id" id="visit_id">

                     @foreach($users as $user)

                     <option value="{{ $user->id }}"
                      @isset ($user->user[0]->name)
                      @if ($user->name == $user->user[0]->name)
                      selected 
                      @endif
                      @endisset


                      >{{ $user->name }} - {{ $user->fname }}</option>

                      @endforeach

                    </select> 

                

                    
              </div-->
@endsection