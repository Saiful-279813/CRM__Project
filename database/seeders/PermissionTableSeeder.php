<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //data for permissions table
        $data = [

            //For Menu System



            //For Role System...
            ['name' => 'role-access', 'group_name' => 'role' ],
            ['name' => 'role-list' , 'group_name' => 'role'],
            ['name' => 'role-create', 'group_name' => 'role'],
            ['name' => 'role-show', 'group_name' => 'role'],
            ['name' => 'role-edit', 'group_name' => 'role'],
            ['name' => 'role-delete', 'group_name' => 'role'],

            //For User System...
            ['name' => 'user-access', 'group_name' => 'user' ],
            ['name' => 'user-list', 'group_name' => 'user' ],
            ['name' => 'user-create', 'group_name' => 'user' ],
            ['name' => 'user-show', 'group_name' => 'user' ],
            ['name' => 'user-edit', 'group_name' => 'user' ],
            ['name' => 'user-delete', 'group_name' => 'user' ]

        ];
        Permission::insert($data);








        //Data for role user pivot
        $dev = User::where('email', 'admin@gmail.com')->first();
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => $dev->id]
        ];

        DB::table('model_has_roles')->insert($data);





        //Data for role permission pivot
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $data = [
                ['permission_id' => $value->id, 'role_id' => 1],
            ];

            DB::table('role_has_permissions')->insert($data);
        }
    }
}
