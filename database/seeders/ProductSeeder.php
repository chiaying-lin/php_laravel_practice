<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //upsert([資料形式],[key唯一值],[更新的項目])
        Product::upsert([
            ['id' => 1, 'title' => '固定資料', 'content' => '固定內容', 'price' => rand(0, 300), 'quantity' => 20],
            ['id' => 2, 'title' => '固定資料', 'content' => '固定內容', 'price' => rand(0, 300), 'quantity' => 20]
        ], ['id'], ['price', 'quantity']);
    }
}
