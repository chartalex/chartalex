<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class ShopController extends Controller
{
    public function index () {

		$products = \App\Product::all();
		$groups = \App\ProductGroup::all();

		// add stock by group
		foreach ($products as $product) {
			if ($product->stock > 0) {
				$groups[$product->group_id - 1]->stock = $groups[$product->group_id -1]->stock + $product->stock;
			}
		}

		foreach ($groups as $group){
			if ($group->stock <= 0) {
				unset($groups[$group->id -1]);
			}
		}
		

		return View('shop', compact('products', 'groups'));
    }
}
