@extends('adminlte::page')

@section('content')

 

<div class="container">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-md-4">
       <div class="card card-primary card-outline">
           <div class="card-header text-center" style="font-family: monospace;"><h2  style="font-size: 26px;">{{ __('Perfil  usuario') }}</h2></div>
          <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                       src="https://picsum.photos/300/300"
                       alt="User profile picture">
              </div>

                <h3 class="profile-username text-center"  style="font-family: monospace;" >{{ old('usu',$user->usu) }}</h3>

                @foreach($role as $rol)

                <p class="text-muted text-center"  style="font-family: monospace;  font-size: 18px;" >{{ $rol->name }}</p>

                 @endforeach
                 <hr style=" background-color: #0f83ff">
                  <ul class="list-group list-group-unbordered mb-3">

                    <li class="list-group-item">
                      <b>Nombres:</b> <a class="float-right">{{ old('name', $user->name) }} - {{ old('sname',$user->sname) }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Apelldos:</b> <a class="float-right">{{ old('fname',$user->fname) }} - {{ old('slname',$user->slname) }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Tipo de identificacion:</b> <a class="float-right">{{ old('typeident',$user->typeident) }}</a>
                   </li>
                   <li class="list-group-item">
                      <b>Identificacion:</b> <a class="float-right">{{ old('ident',$user->ident) }}</a>
                   </li>
                   <li class="list-group-item">
                      <b>Fecha de nacimiento:</b> <a class="float-right">{{ old('fnaci',$user->fnaci) }}</a>
                   </li>

                    <li class="list-group-item">
                      <b>Direccion:</b> <a class="float-right">{{ old('direc',$user->direc) }}</a>
                   </li>

                    <li class="list-group-item">
                      <b>Correo electrónico:</b><a class="float-right">{{ old('email',$user->email) }}</a>
                   </li>
                     <li class="list-group-item">
                      <b>último inicio de sesión:</b><a class="float-right">{{  auth()->user()->last_sign_in_at}}</a>
                   </li>

                </ul>
                 <hr style=" background-color: #0f83ff">

            </div>
          </div>
      </div>

      <div class="col-md-8">
         <div class="card card-primary card-outline">
              <div class="card-header text-center" style="font-family: monospace;"><h2  style="font-size: 26px;">{{ __('Edicion DeL Usuario') }}</h2></div>

              <div class="card-body">
                    @include('custom.message')

                <form action="{{route('perfil.update', auth()->user()->id)}}" method="POST">
                          @csrf
                          @method('PUT') 

                <input type="hidden" name="_method" value="PUT">
                   <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                           <label for="name" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                           <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>
                          </div>
                       </div>

                         <div class="col-md-4">  
                            <div class="form-group">
                              <label for="sname" class="col-form-label text-md-right">{{ __('Segundo nombre') }}
                               </label>
                                   <input id="sname" type="text" class="form-control" name="sname" value="{{ old('sname',$user->sname) }}" autocomplete="sname" autofocus>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                             <label for="fname" class="col-form-label text-md-right">{{ __('Apellido') }}</label>
                            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname',$user->fname) }}" autocomplete="fname" autofocus>
                           </div>
                         </div>

                    </div>
                                <!--/////////////////////////////////////////-->
                                
                     <div class="row">
                          <div class="col-md-4">
                             <div class="form-group">
                                   <label for="slname" class="col-form-label text-md-right">{{ __('Segundo apellido') }}
                                   </label>

                                 
                                     <input id="slname" type="text" class="form-control" name="slname" value="{{ old('slname',$user->slname) }}" autocomplete="slname" autofocus>

                                    
                                </div>
                             </div>
                       
                             <!--/////////////////////////////////////////-->
                          
                             <div class="col-md-4">   
                                <div class="form-group">
                                    <label for="typeident" class="col-form-label text-md-right">{{ __('Tipo de identificacion') }}
                                    </label>

                              <input id="typeident" type="text" class="form-control" name="typeident" value="{{ old('typeident',$user->typeident) }}" autocomplete="typeident" autofocus>

                                   
                                </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                   <label for="ident" class="col-form-label text-md-right">{{ __(' Identificacion') }}
                                   </label>

                                
                                   <input id="ident" type="text" class="form-control" name="ident" value="{{ old('ident',$user->ident) }}" autocomplete="ident" autofocus>

                                   
                                 </div>
                             </div>
                           </div>
                      <div class="row">  
                       
                            <!--/////////////////////////////////////////-->
                        
                      <div class="col-md-4">
                          <div class="form-group">
                               <label for="fnaci" class="col-form-label text-md-right">{{ __('Fecha de nacimiento') }}
                               </label>

                             
                              <input disabled id="fnaci" type="date" class="form-control" name="fnaci" value="{{ old('fnaci',$user->fnaci) }}" autocomplete="fnaci" autofocus>

                                  
                          </div>
                        </div>
                         
                        <div class="col-md-4">
                            <div class="form-group ">

                               <label for="direc" class="col-form-label text-md-right">{{ __('Direccion') }}
                               </label>

                             
                               <input id="direc" type="text" class="form-control" name="direc" value="{{ old('direc',$user->direc) }}" autocomplete="direc" autofocus>

                               
                            </div>
                        </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                      <label for="email" class="col-form-label text-md-right">{{ __('Correo electrónico') }}
                                      </label>

                                    
                                      <input id="email" type="email" class="form-control " name="email" value="{{ old('email',$user->email) }}" autocomplete="email">

                                </div>
                             </div>

                       </div>

                           <!--/////////////////////////////////////////-->
                          <div class="row">
                           
                             
                             <div class="col-md-4">
                                <div class="form-group">
                                      <label for="usu" class="col-form-label text-md-right">{{ __('Usuario') }}
                                      </label>

                                    
                                      <input  disabled id="usu" type="text" class="form-control" name="usu" value="{{ old('usu',$user->usu) }}" autocomplete="usu" autofocus>

                                    
                                </div>
                             </div>
                         

                             <div class="col-md-4">   
                                <div  class="form-group" >
                                  <label for="roles" class="col-form-label text-md-right">{{ __('Roles') }}
                                  </label>

                                   <select  disabled

                                    
                                    class="form-control" name="roles" id="roles"
                                    >
                                   
                                     @foreach($roles as $role)

                                            
                                     <option  value="{{ $role->id }}"

                                      @isset ($user->roles[0]->name)
                                          @if ($role->name == $user->roles[0]->name)
                                           selected  
                                          @endif
      
                                      @endisset

                                    >
                                       {{ $role->name }}</option>

                                     @endforeach

                                   </select> 
                                   
                                </div>
                             </div>
                              <div class="col-md-4">
                                  <div class="form-group ">
                                   <label for="password" class="col-form-label text-md-right">{{ __('Nueva contraseña') }}
                                   </label>


                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                               </div>
                             </div>

                             
                         </div> 
                         <div class="row">
                             <div class="col-md-4">
                              <div class="form-group">
                                  <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirme La Contraseña') }}</label>

                                 
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                  </div>
                           </div>
                         </div>
                            <hr style=" background-color: #0f83ff">
                    
                           <input class=" btn btn-primary" type="submit" value="Actualizar">
                       
                      </div>  
                          
                  </form>

            </div>
        </div>
      </div>
   </div>
</div>

@endsection