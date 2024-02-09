<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            array('address_id'=>1, 'note'=>'Hang de vo', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>1, 'note'=>'Hang kho vo', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>2, 'note'=>'Hang qua mac', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>2, 'note'=>'Hang qua re', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>3, 'note'=>'Hang qua dom', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>3, 'note'=>'Hang qua chat luong', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>4, 'note'=>'Hang qua dep', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('address_id'=>4, 'note'=>'Hang qua xau', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
    }
}
