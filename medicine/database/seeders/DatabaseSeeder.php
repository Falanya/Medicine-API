<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(ProductOrdersTableSeeder::class);
        $this->call(ImgProductsTableSeeder::class);
        $this->call(FavoriteTableSeeder::class);
    }
}
