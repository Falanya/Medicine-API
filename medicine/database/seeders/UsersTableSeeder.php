<?php

namespace Database\Seeders;

use App\Models\User;
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
            array('fullname'=>'Admin', 'email'=>'admin@gmail.com', 'phone' => '0123456789', 'address' => 'Ho Chi Minh', 'password'=>Hash::make('admin'), 'role_id'=>2,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van A', 'email'=>'A@gmail.com', 'phone' => '0123456789', 'address' => 'Ho Chi Minh', 'password'=>Hash::make('123456'), 'role_id'=>1,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van B', 'email'=>'B@gmail.com', 'phone' => '0123456789', 'address' => 'Ho Chi Minh', 'password'=>Hash::make('123456'), 'role_id'=>1 ,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('fullname'=>'Nguyen Van C', 'email'=>'C@gmail.com', 'phone' => '0123456789', 'address' => 'Ho Chi Minh', 'password'=>Hash::make('123456'), 'role_id'=>1,
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
        User::factory()->count(100)->create();
    }
}