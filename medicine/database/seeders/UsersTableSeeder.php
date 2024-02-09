<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            array('fullname'=>'Admin', 'email'=>'admin@gmail.com', 'password'=>Hash::make('admin'), 'role_id'=>2,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van A', 'email'=>'A@gmail.com', 'password'=>Hash::make('123456'), 'role_id'=>1,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van B', 'email'=>'B@gmail.com', 'password'=>Hash::make('123456'), 'role_id'=>1 ,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van C', 'email'=>'C@gmail.com', 'password'=>Hash::make('123456'), 'role_id'=>1,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
    }
}
