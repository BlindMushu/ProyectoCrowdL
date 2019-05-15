<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>  'DanielQM',
            'email'     =>  'danielm@gmail.com',
            'password'  =>   bcrypt('danielm'),
            'type'      =>   'member'
        ]);

        DB::table('users')->insert([
            'name'      =>  'DanielQuispeMamani',
            'email'     =>  'danielmm@gmail.com',
            'password'  =>   bcrypt('danielmm'),
            'type'      =>   'member'
        ]);

        DB::table('users')->insert([
            'name'      =>  'DanielQA',
            'email'     =>  'danieladm@gmail.com',
            'password'  =>   bcrypt('danieladm'),
            'type'      =>   'admin'
        ]);
    }
}
