@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card card-primary card-outline">
        <div class="card-header"><h2 style="font-family: monospace;">{{ __('Habilitar Permiso') }}</h2></div>

        <div class="card-body">
          @include('custom.message')


          <form action="{{route('permiso.update', $permiso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                 <label for="fechainicio" class="col-form-label text-md-right">{{ __('Fecha inicial permiso') }}</label>

                 <input disabled id="fechainicio" type="date" class="form-control @error('fechainicio') is-invalid @enderror" name="fechainicio" value="{{ old('fechainicio', $permiso->fechainicio) }}" autocomplete="fechainicio" autofocus>

                 @error('fechainicio')
                 <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
             <div class="form-group">

               <label for="fechafinal" class="col-form-label text-md-right">{{ __('Fecha final permiso') }}</label>

               <input disabled id="fechafinal" type="date" class="form-control @error('fechafinal') is-invalid @enderror" name="fechafinal" value="{{ old('fechafinal',$permiso->fechafinal) }}" autocomplete="fechafinal" autofocus>

               @error('fechafinal')
               <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">

           <div class="form-group">
             <label for="horainicio" class="col-form-label text-md-right">{{ __('Hora inicial permiso') }}</label>

             <input disabled id="horainicio" type="time" class="form-control @error('horainicio') is-invalid @enderror" name="horainicio" value="{{ old('horainicio',$permiso->horainicio) }}" autocomplete="horainicio" autofocus>

             @error('horainicio')
             <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
         <div class="form-group">
           <label for="horafinal" class="col-form-label text-md-right">{{ __('Hora final permiso') }}</label>

           <input disabled  id="horafinal" type="time" class="form-control @error('horafinal') is-invalid @enderror" name="horafinal" value="{{ old('horafinal',$permiso->horafinal) }}" autocomplete="horafinal" autofocus>

           @error('horafinal')
           <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
       <div class="form-group">

        <label for="user_id" class="col-form-label text-md-right">{{ __('Nombre y Apellido') }}
        </label>

        <select disabled  class="form-control" name="user_id" id="user_id">

         @foreach($permilist as $permis)

         <option value="{{ old('$permis->id',$permis->id) }}"

        >{{ $permis->name }} - {{ $permis->fname}}</option>

          @endforeach

        </select> 
      </div>
    </div>

  
   <div class="col-md-6">
      <div class="form-group">

        <label for="permittype_id" class="col-form-label text-md-right">{{ __('Tipo de permiso') }}
        </label>

        <select disabled  class="form-control" name="permittype_id" id="permittype_id">

         @foreach($permilist as $permis)

         <option value="{{ old('$permis->id',$permis->id) }}"


          >{{ $permis->nombrept}}</option>

          @endforeach

        </select> 

      </div>
    </div>
  </div>   

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">

        <label  for="description" class="col-form-label text-md-right">{{ __('Descripcion') }}</label>
        <textarea disabled class="form-control"  name="description" placeholder="Descripcion" id="description" rows="3">{{ old('description', $permis->description)}}</textarea>

      </div>

      
      <div class="form-group">

        <label for="sede" class="col-form-label text-md-right">{{ __('Sede') }}
        </label>

        <select disabled  class="form-control" name="sede" id="sede">

         @foreach($permilist as $permis)

         <option value="{{ old('$permis->id',$permis->id) }}"


          >{{ $permis->sede}}</option>

          @endforeach

        </select> 

      </div>

      @foreach($permilist as $permis)
      @endforeach
      <div class="form-group">
       <label for="permitstatus_id" class="col-form-label text-md-right">{{ __('Estado permiso') }}
       </label>
       <select disabled  class="form-control" name="permitstatus_id" id="permitstatus_id">

         <option value="{{ old('$permis->id',$permis->id) }}">{{$permis->namep}}</option>

       </select>
     </div>
 
   </div>

 </div>

 

 <div class="modal-footer">

  <a class="btn btn-danger"  href="{{ route('permiso.index') }}">Cancelar</a>

@foreach($attachments as $attachment)



@endforeach
@if($attachment->ruta == null)

 <a href="{{route('download', $permiso->id)}}" hidden  class="btn btn-secondary"><i class="fas fa-cloud-download-alt" >  Descargar archivo  </i></a>
@else     

 <a href="{{route('download', $permiso->id)}}"   class="btn btn-secondary"><i class="fas fa-cloud-download-alt" >  Descargar archivo  </i></a>
 
@endif 


 <button class="btn btn-primary" name="permitstatus_id" type="submit" value="2">Aprobar</button>

 <button class="btn btn-warning" style="background: #fd7e14; color: #fff; border-color: #fd7e14" name="permitstatus_id" type="submit" value="3">No Aprobar</button>


</div>

</form>

</div>
</div>
</div>
</div>
</div>
@endsection