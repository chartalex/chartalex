<?php

use Illuminate\Database\Seeder;

class ProductGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$groups = [
            ['id' => 1, 'name' => 'Caleçon Citron', 'attribute' => 'Coutures Orange', 'prefix' => 'calecon-citron', 'price' => 12, 'price_prod' => 5, 'price_vat' => 2, 'price_mclh' => 5],
            ['id' => 2, 'name' => 'Caleçon Pêche', 'attribute' => 'Coutures Rouges', 'prefix' => 'calecon-peche', 'price' => 12, 'price_prod' => 5, 'price_vat' => 2, 'price_mclh' => 5],
        ];

        DB::table('product_groups')->insert($groups);
    }
}