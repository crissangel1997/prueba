@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header col-form-label " style="font-size: 20px;  font-family: sans-serif;">{{ __('Registro De Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('user.store') }}">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                               <label for="name" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                 </div>
                           </div>


                           <div class="col-md-6">  
                              <div class="form-group">
                                 <label for="sname" class="col-form-label text-md-right">{{ __('Segundo nombre') }}
                                 </label>

                               
                                   <input id="sname" type="text" class="form-control @error('sname') is-invalid @enderror" name="sname" value="{{ old('sname') }}" autocomplete="sname" autofocus>

                                   @error('sname')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                              </div>
                           </div>
                        </div>
                        <!--/////////////////////////////////////////-->
                        
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                               <label for="fname" class="col-form-label text-md-right">{{ __('Apellido') }}</label>

                               
                                   <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" autocomplete="fname" autofocus>

                                   @error('fname')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                              </div>
                           </div>

                        <div class="col-md-6">
                           <div class="form-group">
                                 <label for="slname" class="col-form-label text-md-right">{{ __('Segundo apellido') }}
                                 </label>

                               
                                   <input id="slname" type="text" class="form-control @error('slname') is-invalid @enderror" name="slname" value="{{ old('slname') }}" autocomplete="slname" autofocus>

                                   @error('slname')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                              </div>
                           </div>
                        </div>
                           <!--/////////////////////////////////////////-->
                        <div class="row">
                           <div class="col-md-6">   
                              <div class="form-group">
                                  <label for="typeident" class="col-form-label text-md-right">{{ __('Tipo De identificacion') }}
                                  </label>

                           
                                   <input id="typeident" type="text" class="form-control @error('typeident') is-invalid @enderror" name="typeident" value="{{ old('typeident') }}" required autocomplete="typeident" autofocus>

                                   @error('typeident')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="ident" class="col-form-label text-md-right">{{ __(' Identificacion') }}
                                 </label>

                              
                                 <input id="ident" type="text" class="form-control @error('ident') is-invalid @enderror" name="ident" value="{{ old('ident') }}" required autocomplete="ident" autofocus>

                                 @error('ident')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                               </div>
                           </div>
                        </div>
                          <!--/////////////////////////////////////////-->
                        <div class="row">
                           <div class="col-md-6">
                            <div class="form-group">
                                 <label for="fnaci" class="col-form-label text-md-right">{{ __('Fecha De nacimiento') }}
                                 </label>

                               
                                   <input id="fnaci" type="date" class="form-control @error('fnaci') is-invalid @enderror" name="fnaci" value="{{ old('fnaci') }}" autocomplete="fnaci" autofocus>

                                    @error('fnaci')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                               </div>
                           </div>
                           
                           <div class="col-md-6">
                              <div class="form-group ">

                                 <label for="direc" class="col-form-label text-md-right">{{ __('Direccion') }}
                                 </label>

                               
                                 <input id="direc" type="text" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{ old('direc') }}" autocomplete="direc" autofocus>

                                 @error('direc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>
                        </div>

                         <!--/////////////////////////////////////////-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">{{ __('Correo electrónico') }}
                                    </label>

                                  
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                    @error('email')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                              </div>
                           </div>
                           

                           <div class="col-md-6">
                              <div class="form-group">
                                    <label for="usu" class="col-form-label text-md-right">{{ __('Usuario') }}
                                    </label>

                                  
                                    <input id="usu" type="text" class="form-control @error('usu') is-invalid @enderror" name="usu" value="{{ old('usu') }}" required autocomplete="usu" autofocus>

                                    @error('usu')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                              </div>
                           </div>
                        </div> 

                         
                        <!--/////////////////////////////////////////-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group ">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}
                                     </label>

                                 
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                  <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirme La Contraseña') }}</label>

                                 
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                  </div>
                           </div>

                        </div>  

                              <div class="row">
                                   <div class="col-md-6">   
                                      <div class="form-group">
                                        <label for="roles" class="col-form-label text-md-right">{{ __('Roles') }}
                                        </label>

                                         <select class="form-control" name="roles" id="roles">
                                         
                                           @foreach($roles as $role)
                                          
                                           <option value="{{ $role->id }}"
                                            @isset ($user->roles[0]->name)
                                                @if ($role->name == $user->roles[0]->name)
                                                 selected 
                                                @endif
                                            @endisset


                                            >{{ $role->name }}</option>

                                           @endforeach

                                         </select> 
                                         
                                      </div>
                                   </div>
                               </div>

                         
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Resgistrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
