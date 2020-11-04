 <?php

use Illuminate\Database\Seeder;
use App\User;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class PermissionInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement("SET foreign_key_checks=0");
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate(); 
        Permission::truncate();
        Role::truncate();
        DB::statement("SET foreign_key_checks=1");


    	$useradmin = User::where('usu','crissangel')->first();
    	if ($useradmin) {
    		$useradmin->delete();
    	}

    	$useradmin = User::create([
        //user admin
        'name'     => 'cristian',
        'sname'    => 'camilo',
        'fname'    => 'fernandez',
        'slname'   => 'Jimenez',
        'typeident'=> 'cc',
        'ident'    => '16666465',
        'fnaci'    => '2020/06/19',
        'direc'    => 'turbaco',
        'email'	   => 'criss@gmail.com',
        'usu' 	   => 'crissangel',
        'password' => Hash::make('admin')

        ]);

        /*Rol admin*/
        $roladmin = Role::create([

  	   'name' 		 => 'Admin',
  	   'slug' 		 =>  'admin',
  	   'description' => 'Administrador',
  	   'full-access' =>  'yes'	

       ]);

      /*registrar usuario*/
        $roluser = Role::create([

       'name'        => 'Agente',
       'slug'        =>  'Agen',
       'description' => 'Agente',
       'full-access' =>  'no'  

       ]);

        /*table role user*/
    $useradmin->roles()->sync([$roladmin->id]);

        

        /* permission role*/
         
        $permission_all = [];
    $permission = Permission::create([

	   'name'  => 'List role',
	   'slug'  =>  'role.index',
	   'description' => 'A user  can List role'

	]);

    $permission_all[] = $permission->id;

        $permission = Permission::create([

	   'name'  => 'Show role',
	   'slug'  =>  'role.show',
	   'description' => 'A user  can see role'

	]);

    $permission_all[] = $permission->id;

        $permission = Permission::create([

	   'name'  => 'Create role',
	   'slug'  =>  'role.create',
	   'description' => 'A user  can create role'

	]);

    $permission_all[] = $permission->id;

        $permission = Permission::create([

	   'name'  => 'Edit role',
	   'slug'  =>  'role.edit',
	   'description' => 'A user  can edit role'

	]);

    $permission_all[] = $permission->id;

        $permission = Permission::create([

	   'name'  => 'Destroy role',
	   'slug'  =>  'role.destroy',
	   'description' => 'A user  can destroy role'

	]);

    $permission_all[] = $permission->id;

       /*table permission_role*/
    //$roladmin->permissions()->sync($permission_all);


     /*permission user*/

    $permission = Permission::create([

	   'name'  => 'List user',
	   'slug'  =>  'user.index',
	   'description' => 'A user  can List user'

	]);

    $permission_all[] = $permission->id;

   $permission = Permission::create([

	   'name'  => 'Show user',
	   'slug'  =>  'user.show',
	   'description' => 'A user  can see user'

	]);

    $permission_all[] = $permission->id;

       
    $permission = Permission::create([

	   'name'  => 'Edit user',
	   'slug'  =>  'user.edit',
	   'description' => 'A user  can edit user'

	]);

    $permission_all[] = $permission->id;

    $permission = Permission::create([

	   'name'  => 'Destroy user',
	   'slug'  =>  'user.destroy',
	   'description' => 'A user  can destroy user'

	]);


    $permission_all[] = $permission->id;


    $permission = Permission::create([

       'name'  => 'Show own user',
       'slug'  =>  'userown.show',
       'description' => 'A user  can see own user'

    ]);

    $permission_all[] = $permission->id;

       
    $permission = Permission::create([

       'name'  => 'Edit own user',
       'slug'  =>  'userown.edit',
       'description' => 'A user  can edit own user'

    ]);
    
    $permission_all[] = $permission->id;

    $permission = Permission::create([

	   'name'  => 'Create user',
	   'slug'  =>  'user.create',
	   'description' => 'A user  can create user'

	]);


    /*--------Almuerzos -----------------*/
    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'List lunch',
       'slug'  =>  'almuerzo.index',
       'description' => 'A lunch can List lunch'
    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Create lunch',
       'slug'  =>  'almuerzo.create',
       'description' => 'A lunch can create lunch'
    ]);
    
    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  =>  'Destroy lunch',
       'slug'  =>  'almuerzo.destroy',
       'description' => 'A lunch can destroy lunch'
    ]);

    /*$permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  =>  'Show lunch',
       'slug'  =>  'almuerzo.show',
       'description' => 'A lunch can show lunch'
    ]);*/

    /*-------- Menu Almuerzos -----------------*/
    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'List menu',
       'slug'  =>  'menualmuerzo.index',
       'description' => 'A menu can List menu'

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Create menu',
       'slug'  =>  'malmuerzo.create',
       'description' => 'A menu can create menu'

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Show menu',
       'slug'  =>  'malmuerzo.show',
       'description' => 'A menu can show menu'

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Edit menu',
       'slug'  =>  'malmuerzo.edit',
       'description' => 'A menu can edit menu'

    ]);

     $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Destroy menu',
       'slug'  =>  'malmuerzo.destroy',
       'description' => 'A menu can destroy menu'

    ]);


  /*----++---- Menu Cena -----------++----*/

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'List  menu dinner',
       'slug'  =>  'menucena.index',
       'description' => 'A menu dinner can List menu dinner'

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Create menu dinner',
       'slug'  =>  'menucena.create',
       'description' => 'A menu dinner can create menu dinner '

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Show  menu dinner',
       'slug'  =>  'menucena.show',
       'description' => 'A menu dinner can show menu dinner'

    ]);

    $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Edit menu dinner',
       'slug'  =>  'menucena.edit',
       'description' => 'A menu dinner can edit menu dinner'

    ]);

     $permission_all[] = $permission->id;

     $permission = Permission::create([

       'name'  => 'Destroy menu dinner',
       'slug'  =>  'menucena.destroy',
       'description' => 'A menu dinner can destroy menu dinner'

    ]);
     
      /*----++---- Menu Cena -----------++----*/
      $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'List  dinner',
       'slug'  =>  'cena.index',
       'description' => 'A  dinner can List  dinner'
  ]);

       $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'Create  dinner',
       'slug'  =>  'cena.create',
       'description' => 'A  dinner can List  dinner'
  ]);


      $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'Destroy   dinner',
       'slug'  =>  'cena.destroy',
       'description' => 'A  dinner can List  dinner'



    ]);


      $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'List  visit',
       'slug'  =>  'visita.index',
       'description' => 'A  visit can List  visit'

    ]);


      $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'Create  visit',
       'slug'  =>  'visita.create',
       'description' => 'A  visit can create  visit'

      ]);

      $permission_all[] = $permission->id;

      $permission = Permission::create([

       'name'  => 'Destroy  visit',
       'slug'  =>  'visita.destroy',
       'description' => 'A  visit can destroy  visit'

      ]);





     /*hacer el db:seed a lo ultimo*/

    /* $roladmin->permissions()->sync($permission_all);*/
       
    }
}
