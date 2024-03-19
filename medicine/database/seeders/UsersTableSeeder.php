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
            [
                'fullname' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('admin'),
                'birthday' => "2003/01/01",
                'role_id' => 2,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
            [
                'fullname' => 'Nguyen Van A',
                'email' => 'A@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'birthday' => "2003/01/01",
                'role_id' => 1,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
            [
                'fullname' => 'Nguyen Van B',
                'email' => 'B@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'birthday' => "2003/01/01",
                'role_id' => 1,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
            [
                'fullname' => 'Nguyen Van C',
                'email' => 'C@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'birthday' => "2003/01/01",
                'role_id' => 1,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
            [
                'fullname' => 'Huy Béo',
                'email' => 'lakewood12112003@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'birthday' => "2003/01/01",
                'role_id' => 1,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
            [
                'fullname' => 'Tuấn',
                'email' => 'vtuan0612@gmail.com',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'birthday' => "2003/01/01",
                'role_id' => 1,
                'email_verified_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ],
        ]);
        User::factory()->count(100)->create();
    }
}