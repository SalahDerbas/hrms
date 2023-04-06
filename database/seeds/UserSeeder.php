<?php

namespace Database\Seeders;

use App\User;


use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'            => 'admin'                         ,
            'email'           => 'admin@admin.com'               ,
            'password'        => Hash::make('12345678')    ,
            'phone'           =>  987654321                      ,
            'firstname'       => 'first'                             ,
            'lastname'        => 'last'                             ,
            'gender'          => 'Male'                          ,
            'material_status' => 'Single'                        ,
            'role_id'         => 1                               ,
            'status'          => 'Active'                        ,
            'photo'           => 'http://localhost:8000/assets/img/Logo.png',
        ]);

        $role = Role::create([ 'name' => 'Owner' ]);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
