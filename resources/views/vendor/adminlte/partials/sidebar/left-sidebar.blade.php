<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}

    <div class="sidebar">
        
        <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">

                        <li class="nav-header ">

                            MENU
                        </li>
                        <li class="nav-item">

                            <a class="nav-link  " href="http://prueba.test/home">

                                <i class="fas fa-home "></i>

                                <p>
                                 Inicio

                             </p>

                         </a>

                     </li>

                     <li class="nav-item has-treeview ">


                        <a class="nav-link  " href="">

                         <i class="fas fa-plus-circle "></i>

                            <p>
                                Alimentacion
                                <i class="fas fa-angle-left right"></i>

                            </p>

                        </a>


                        <ul class="nav nav-treeview">
                          @can('haveaccess','almuerzo.index')
                            <li class="nav-item">

                                <a class="nav-link  " href="http://prueba.test/almuerzo">

                                    <i class="fas fa-utensils "></i>

                                    <p>
                                     Almuezo
                                  </p>

                             </a>

                         </li> 
                         @endcan

                        @can('haveaccess','cena.index')
                         <li class="nav-item">

                            <a class="nav-link  " href="http://prueba.test/cena">

                                <i class="fas fa-wine-glass-alt "></i>

                                <p>
                                 Cena

                             </p>

                         </a>

                        </li>
                        @endcan 

                        @can('haveaccess','menualmuerzo.index')
                        <li class="nav-item">

                           <a class="nav-link  " href="http://prueba.test/malmuerzo">

                                <i class="fas fa-list "></i>

                                    <p>
                                     Menu Almuerzo

                                 </p>

                             </a>

                         </li>
                        @endcan
                        @can('haveaccess','menucena.index')
                         <li class="nav-item">

                            <a class="nav-link  " href="http://prueba.test/menucena">

                                <i class="fas fa-list-ul "></i>

                                <p>
                                 Menu Cena

                             </p>

                         </a>

                     </li> 
                     @endcan
                 </ul>

             </li>
             @can('haveaccess','user.index')
             <li class="nav-item has-treeview ">


                <a class="nav-link  " href="">

                    <i class="fas fa-plus-square "></i>

                    <p>
                        Reportes
                        <i class="fas fa-angle-left right"></i>

                    </p>

                </a>

            
                <ul class="nav nav-treeview">

                 @can('haveaccess','almuerzototal.index')
                    <li class="nav-item">

                        <a class="nav-link  " href="http://prueba.test/almuerzototal">

                            <i class="far fa-clipboard "></i>

                            <p>
                             Almuerzos Totales

                         </p>

                     </a>

                 </li> 
               @endcan
               @can('haveaccess','cenatotal.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/cenatotal">

                        <i class="fas fa-clipboard-list "></i>

                                <p>
                                 Cena Total

                             </p>

                         </a>

                     </li> 
                  @endcan

                 </ul>

               </li>
               @endcan

              @can('haveaccess','visita.index')
               <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/visita">

                        <i class="fas fa-user-friends "></i>

                        <p>
                         Visita

                     </p>

                 </a>

                </li> 
                @endcan
                 @can('haveaccess','user.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/confighora">

                    <i class="far fa-clock"></i>

                        <p>
                            Hora Limite

                        </p>

                    </a>

                </li> 
                @endcan
                 @can('haveaccess','permisotipo.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/permisotipo">

                    <i class="fas fa-thumbtack"></i>

                        <p>
                          Tipo Permiso

                        </p>

                    </a>

                </li> 
                @endcan
                @can('haveaccess','permiso.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/permiso">

                    <i class="fas fa-stamp"></i> 

                        <p>

                          Permiso Administrador

                        </p>

                    </a>

                </li> 
                @endcan
                @can('haveaccess','permisouser.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/permisouser">

                    <i class="fas fa-door-open"></i>

                        <p>

                          Permiso 

                        </p>

                    </a>

                </li> 
                @endcan
                 @can('haveaccess','user.index')
                <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/user">

                        <i class="fas fa-fw fa-user "></i>

                        <p>
                            Usuario

                        </p>

                    </a>

                </li> 
                @endcan
            
             @can('haveaccess','role.index')
              <li class="nav-item">

                    <a class="nav-link  " href="http://prueba.test/role">

                        <i class="fas fa-fw fa-cog "></i>

                        <p>
                            Roles

                        </p>

                    </a>

               </li>
               @endcan

            </ul>

        </nav>
    </div>

</aside>
