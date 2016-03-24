<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class IndexController extends Controller
{

	public function index () {

		//Carbon::setLocale('fr');

		$onk_quit_date = Carbon::create(2016, 01, 02, 0)->diffInDays();

		$instas = [
					['date'		=> Carbon::create(2016, 3, 18, 0)->diffForHumans(null, true),
					 'pic'		=> 'img/insta/almograve.jpg',
					 'url'		=> 'https://www.instagram.com/p/BDGyDijlaGg/',
					 'loc_name' => 'Praia de Almograve, Portugal',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/235589218/',
					 'text'		=> 'Do you like my new garden? #nohome #everywhereishome',
					 'likes'	=> '20'],				
					['date'		=> Carbon::create(2016, 2, 10, 0)->diffForHumans(null, true),
					 'pic'		=> 'img/insta/faro.jpg',
					 'url'		=> 'https://www.instagram.com/p/BBnCNsvlaKl/',
					 'loc_name' => 'Ilha de Faro',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/134200630/',
					 'text'		=> 'Good spot to lunch before #kitesurf #faro #algarve 🌊🌪🏄',
					 'likes'	=> '32'],
					['date'		=> Carbon::create(2016, 1, 23, 0)->diffForHumans(null, true),
					 'pic'		=> 'img/insta/ferragudo.jpg',
					 'url'		=> 'https://www.instagram.com/p/BA38T_qlaKO/',
					 'loc_name' => 'Ferragudo Algarve Portugal',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/300122270/',
					 'text'		=> 'Bom dia #portimao',
					 'likes'	=> '14'],					 
		];

		//$dates = Carbon::create(2016, 2, 22, 0)->diffForHumans();      


		$products = \App\Product::take(3)->get();
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

	    return view('welcome', array(
	    	'instas' => $instas,
	    	'onk_quit_date' => $onk_quit_date,
	    	'products' => $products,
	    	'groups' => $groups
	    	));

	}
}
