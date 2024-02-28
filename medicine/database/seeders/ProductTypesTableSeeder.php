<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_types')->insert([
            array('name'=>'Chăm sóc cá nhân', 'slug'=>'cham-soc-ca-nhan', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Chăm sóc sắc đẹp', 'slug'=>'cham-soc-sac-dep', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Chăm sóc sức khỏe', 'slug'=>'cham-soc-suc-khoe', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Dược phẩm', 'slug'=>'duoc-pham', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Mẹ và bé', 'slug'=>'me-va-be', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Thiết bị y tế', 'slug'=>'thiet-bi-y-te', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Thực phẩm chức năng', 'slug'=>'thuc-pham-chuc-nang', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Sản phẩm tiện lợi', 'slug'=>'san-pham-tien-loi', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
    }
}
