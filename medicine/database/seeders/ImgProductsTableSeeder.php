<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImgProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('img_products')->insert([
            array('img' => 'P26254_1.jpg', 'product_id' => 13, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P26254_2.jpg', 'product_id' => 13, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P26254_3.jpg', 'product_id' => 13, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P26254_4.jpg', 'product_id' => 13, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_1.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_3.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_4.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_5.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_6.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_7.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P11034_8.png', 'product_id' => 15, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P27215_1.jpg', 'product_id' => 16, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P27215_2.jpg', 'product_id' => 16, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P27215_3.jpg', 'product_id' => 16, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P27215_4.jpg', 'product_id' => 16, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P27215_5.jpg', 'product_id' => 16, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P25518.png', 'product_id' => 17, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P25518_1.png', 'product_id' => 17, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P25518_3.png', 'product_id' => 17, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P25518_4.png', 'product_id' => 17, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P25518_5.png', 'product_id' => 17, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P17506_1.jpg', 'product_id' => 18, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P17506_2.jpg', 'product_id' => 18, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P17506_3.jpg', 'product_id' => 18, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P17506_4.jpg', 'product_id' => 18, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P04695.png', 'product_id' => 19, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P04695_1.png', 'product_id' => 19, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P04695_3.png', 'product_id' => 19, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P04695_4.png', 'product_id' => 19, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
            array('img' => 'P04695_5.png', 'product_id' => 19, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')),
        ]);
    }
}
