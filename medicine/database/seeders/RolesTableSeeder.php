<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            array('name'=>'Member', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name' =>'Staff', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Admin', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
        ]);
    }
}