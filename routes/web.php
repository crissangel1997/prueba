<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
//Route::get ('auth/logout', 'Auth\AuthController@logout ');


Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/role', 'RoleController')->names('role');

Route::get('/test', function(){

$user  = User::find(2);

  //$user->roles()->sync([2]);
 // return $user->havePermission('role.create');
 Gate::authorize('haveaccess','role.show');

   return  $user;

});

Route::resource('/role', 'RoleController')->names('role');

/*except: mostrara los metodos que se enncuentran en el UserController pero menos el create y el store*/

Route::resource('/user', 'UserController')->names('user');

Route::get('host', 'UserController@gethostnames')->name('host');



//Route::get('/profile', 'UsuarioController@edit')->name('profile');

Route::get('profile',['as'=> 'perfil.edit', 'uses' => 'UsuarioController@edit']);
Route::put('/profile',['as'=> 'perfil.update', 'uses' => 'UsuarioController@update']);
//Route::view('/profile', 'profile')->name('profile');


Route::resource('/almuerzo', 'AlmuerzoController')->names('almuerzo');

//Route::get('/almuerzo', 'AlmuerzoController@insvisit')->name('almuerzo');


Route::resource('/malmuerzo', 'MenuAlmuerzoController')->names('malmuerzo');

Route::resource('/menucena', 'MenuCenaController')->names('menucena');

Route::resource('/cena', 'CenaController')->names('cena');

Route::resource('/visita', 'VisitasController')->names('visita');

Route::resource('almuerzototal', 'AmuerzoTolalController')->names('almuerzototal');

Route::resource('cenatotal', 'CenaTolalController')->names('cenatotal');

Route::get('almuerzo-total-excel', 'AmuerzoTolalController@exportExcel')->name('almtotal.excel');

Route::get('cena-total-excel', 'CenaTolalController@exportExcel')->name('cenatotal.excel');

Route::resource('confighora', 'ConfigController')->names('confighora');

Route::resource('permisotipo', 'PermitsTypeController')->names('permisotipo');

Route::resource('permiso', 'PermitsController')->names('permiso');

Route::resource('permisouser', 'PermitsUserController')->names('permisouser');

Route::get('download', 'PermitsController@download')->name('downloandfile');











