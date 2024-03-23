<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            array('user_id'=>2, 'address'=>'Tan Binh, Ho Chi Minh', 'phone'=>'0123456789', 'receiver_name'=>'Nguyen Van A',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('user_id'=>2, 'address'=>'Tan Phu, Ho Chi Minh', 'phone'=>'0123456789', 'receiver_name'=>'Nguyen Van A',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('user_id'=>3, 'address'=>'Thu Duc, Ho Chi Minh', 'phone'=>'0123456788', 'receiver_name'=>'Nguyen Van B',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('user_id'=>3, 'address'=>'Quan 9, Ho Chi Minh', 'phone'=>'0123456788', 'receiver_name'=>'Nguyen Van B',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('user_id'=>4, 'address'=>'Quan 1, Ho Chi Minh', 'phone'=>'0123456787', 'receiver_name'=>'Nguyen Van C',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('user_id'=>4, 'address'=>'Quan 2, Ho Chi Minh', 'phone'=>'0123456787', 'receiver_name'=>'Nguyen Van C',
            'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'))
        ]);
        Address::factory()->count(1000)->create();
    }
}
