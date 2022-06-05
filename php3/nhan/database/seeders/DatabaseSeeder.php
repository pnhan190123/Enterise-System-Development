<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'hoten'=>'Nguyen Van Teo',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('hehe'),
            'active'=>1,
            'vaitro'=>4,
            'username'=>'teo',
            'diachi'=>'TPHCM',
            'idgroup'=>4,

        ]);
        DB::table('users')->insert([
            'hoten'=>'Nguyen Van Teo',
            'email'=>'accountant@gmail.com',
            'password'=>bcrypt('hehe'),
            'active'=>1,
            'vaitro'=>5,
            'username'=>'teo',
            'diachi'=>'TPHCM',
            'idgroup'=>5,
            'sodu'=>100,

        ]);
        DB::table('users')->insert([
            'hoten'=>'Nguyen Van Teo',
            'email'=>'editor@gmail.com',
            'password'=>bcrypt('hehe'),
            'active'=>1,
            'vaitro'=>2,
            'username'=>'teo',
            'diachi'=>'TPHCM',
            'idgroup'=>2,

        ]);

        DB::table('users')->insert([
            'hoten'=>'Nguyen Van Teo',
            'email'=>'secretariat@gmail.com',
            'password'=>bcrypt('hehe'),
            'active'=>1,
            'vaitro'=>3,
            'username'=>'teo',
            'diachi'=>'TPHCM',
            'idgroup'=>3,

        ]);
        DB::table('users')->insert([
            'hoten'=>'Nguyen Van Teo',
            'email'=>'reporter@gmail.com',
            'password'=>bcrypt('hehe'),
            'active'=>1,
            'vaitro'=>1,
            'username'=>'teo',
            'diachi'=>'TPHCM',
            'idgroup'=>1,

        // ]);
        // // DB::table('users')->insert([
        // //     'hoten'=>'Nguyen Van Teo',
        // //     'email'=>'reporter@gmail.com',
        // //     'password'=>bcrypt('hehe'),
        // //     'active'=>1,
        // //     'vaitro'=>2,
        // //     'username'=>'teo',
        // //     'diachi'=>'TPHCM',
        // //     'idgroup'=>2,

        // // ]);
          
    }
}
