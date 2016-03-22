<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $products = [
            ['id' => 1, 'group_id' => 1, 'name' => 'Caleçon Citron', 'prefix' => 'calecon-citron', 'size' => 'S','price' => 12, 'stock' => 20],
            ['id' => 6, 'group_id' => 2, 'name' => 'Caleçon Pêche', 'prefix' => 'calecon-peche', 'size' => 'M','price' => 12, 'stock' => 20],
        ];

        DB::table('products')->insert($products);
    }
}