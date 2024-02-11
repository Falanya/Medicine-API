<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_orders')->insert([
            array('order_id'=>1, 'product_id'=>1, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>1, 'product_id'=>3, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>1, 'product_id'=>4, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>1, 'product_id'=>1, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>2, 'product_id'=>2, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>2, 'product_id'=>1, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>2, 'product_id'=>3, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>2, 'product_id'=>5, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>3, 'product_id'=>7, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>3, 'product_id'=>8, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>3, 'product_id'=>6, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>3, 'product_id'=>1, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>4, 'product_id'=>1, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>4, 'product_id'=>4, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>4, 'product_id'=>3, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('order_id'=>4, 'product_id'=>7, 'quantity'=>3, 'price' => 200000, 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
    }
}
