@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h2>{{ __('Editar Usuario') }}</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    
                        <form action="{{route('user.update', $user->id) }}" method="POST">
                          @csrf
                            @method('PUT')
                               <div class="row">
                                   <div class="col-md-6">
                                      <div class="form-group">
                                       <label for="name" class="col-form-label text-md-right">{{ __('Nombre') }}</label>

                                             <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

                                             
                                         </div>
                                   </div>


                                   <div class="col-md-6">  
                                      <div class="form-group">
                                         <label for="sname" class="col-form-label text-md-right">{{ __('Segundo nombre') }}
                                         </label>

                                       
                                           <input id="sname" type="text" class="form-control" name="sname" value="{{ old('sname',$user->sname) }}" autocomplete="sname" autofocus>

                                        
                                      </div>
                                   </div>
                                </div>
                                <!--/////////////////////////////////////////-->
                                
                                <div class="row">
                                   <div class="col-md-6">
                                      <div class="form-group">
                                       <label for="fname" class="col-form-label text-md-right">{{ __('Apellido') }}</label>

                                       
                                           <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname',$user->fname) }}" autocomplete="fname" autofocus>

                                           
                                      </div>
                                   </div>

                                <div class="col-md-6">
                                   <div class="form-group">
                                         <label for="slname" class="col-form-label text-md-right">{{ __('Segundo apellido') }}
                                         </label>

                                       
                                           <input id="slname" type="text" class="form-control" name="slname" value="{{ old('slname',$user->slname) }}" autocomplete="slname" autofocus>

                                          
                                      </div>
                                   </div>
                                </div>
                                   <!--/////////////////////////////////////////-->
                                <div class="row">
                                   <div class="col-md-6">   
                                      <div class="form-group">
                                          <label for="typeident" class="col-form-label text-md-right">{{ __('Tipo De Identificacion') }}
                                          </label>

                                    <input id="typeident" type="text" class="form-control" name="typeident" value="{{ old('typeident',$user->typeident) }}" autocomplete="typeident" autofocus>

                                         
                                      </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="ident" class="col-form-label text-md-right">{{ __(' Identificacion') }}
                                         </label>

                                      
                                         <input id="ident" type="text" class="form-control" name="ident" value="{{ old('ident',$user->ident) }}" autocomplete="ident" autofocus>

                                         
                                       </div>
                                   </div>
                                </div>
                                  <!--/////////////////////////////////////////-->
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="fnaci" class="col-form-label text-md-right">{{ __('Fecha de nacimiento') }}
                                         </label>

                                       
                                        <input id="fnaci" type="date" class="form-control" name="fnaci" value="{{ old('fnaci',$user->fnaci) }}" autocomplete="fnaci" autofocus>

                                            
                                    </div>
                                  </div>
                                   
                                  <div class="col-md-6">
                                      <div class="form-group ">

                                         <label for="direc" class="col-form-label text-md-right">{{ __('Direccion') }}
                                         </label>

                                       
                                         <input id="direc" type="text" class="form-control" name="direc" value="{{ old('direc',$user->direc) }}" autocomplete="direc" autofocus>

                                         
                                      </div>
                                  </div>
                                </div>

                                 <!--/////////////////////////////////////////-->
                                <div class="row">
                                   <div class="col-md-6">
                                      <div class="form-group">
                                            <label for="email" class="col-form-label text-md-right">{{ __('Correo electrónico') }}
                                            </label>

                                          
                                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email',$user->email) }}" autocomplete="email">

                                      </div>
                                   </div>
                                   

                                   <div class="col-md-6">
                                      <div class="form-group">
                                            <label for="usu" class="col-form-label text-md-right">{{ __('Usuario') }}
                                            </label>

                                          
                                            <input id="usu" type="text" class="form-control" name="usu" value="{{ old('usu',$user->usu) }}" autocomplete="usu" autofocus>

                                          
                                      </div>
                                   </div>
                                </div> 

                              @can('haveaccess','role.index')
                                <div  class="row">
                                   <div class="col-md-6">   
                                      <div  class="form-group" >
                                        <label for="roles" class="col-form-label text-md-right">{{ __('Roles') }}
                                        </label>

                                         <select 

                                          
                                          class="form-control" name="roles" id="roles"
                                          >
                                         
                                           @foreach($roles as $role)

                                                  
                                           <option value="{{ $role->id }}"

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
                                </div>
                                @endcan

                                <hr>
                                 <input class=" btn btn-primary" type="submit" value="Actualizar">
                            </div>  
                                
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection