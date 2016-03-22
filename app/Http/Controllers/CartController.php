<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Product;


class CartController extends Controller
{

	private $shipping = 5;


	public function cart() {
		if (Request::isMethod('post')) {
	        $product_id = Request::get('product_id');
	        $product = Product::find($product_id);
	        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'options' => array('prefix' => $product->prefix, 'size' => $product->size)));
	    }

	    
	    //add boxer's pack
	    if (Request::get('add_boxers_pack') ) {

	        $size = Request::get('add_boxers_pack');

	        if ($size >= 1 && $size <= 4) {
				for ($x = $size; $x <= 20; $x+=4) {
					$product = Product::find($x);
	        		Cart::add(array('id' => $x, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'options' => array('prefix' => $product->prefix, 'size' => $product->size)));
				} 
	        }
	    }


	    //increment the quantity
	    if (Request::get('product_id') && (Request::get('increment')) == 1) {
	        $rowId = Cart::search(array('id' => Request::get('product_id')));
	        $item = Cart::get($rowId[0]);

	        Cart::update($rowId[0], $item->qty + 1);
	    }

	    //decrease the quantity
	    if (Request::get('product_id') && (Request::get('decrease')) == 1) {
	        $rowId = Cart::search(array('id' => Request::get('product_id')));
	        $item = Cart::get($rowId[0]);

	        Cart::update($rowId[0], $item->qty - 1);
	    }

	    //remove the item
	    if (Request::get('remove')) {
	        $rowId = Cart::search(array('id' => Request::get('remove')));
			if ($rowId != false) { //avoid error if refresh url and product doesn't exist already
				Cart::remove($rowId[0]);
			}
	    }

	    $cart = Cart::content();

	    return view('cart', array('cart' => $cart, 'shipping' => $this->shipping));
	}



	public function destroy() {

		Cart::destroy();

		$cart = Cart::content();

	    return view('cart', array('cart' => $cart, 'shipping' => $this->shipping));
	}

}
