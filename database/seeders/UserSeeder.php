<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = DB::table('roles')->where('role',"=","Admin")->get();
        $adminRoleId = $admin[0];
        User::create([
            'name' => env('USERNAME'),
            'email' => env('EMAIL'),
            'password' => Hash::make(env('PASSWORD')),
            'role_id' => $adminRoleId->id
        ]);
    }
}
