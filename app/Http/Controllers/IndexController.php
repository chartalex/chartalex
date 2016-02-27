<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class IndexController extends Controller
{

	public function index () {

		Carbon::setLocale('fr');


		$instas = [
					['date'		=> Carbon::create(2016, 2, 22, 0)->diffForHumans(),
					 'pic'		=> 'img/insta/lisboa.jpg',
					 'url'		=> 'https://www.instagram.com/p/BCFSFiVFaFn/',
					 'loc_name' => 'Lisbon, Portugal',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/11100843/',
					 'text'		=> 'Bom dia lisboa',
					 'likes'	=> '12'],					
					['date'		=> Carbon::create(2016, 2, 10, 0)->diffForHumans(),
					 'pic'		=> 'img/insta/faro.jpg',
					 'url'		=> 'https://www.instagram.com/p/BBnCNsvlaKl/',
					 'loc_name' => 'Ilha de Faro',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/134200630/',
					 'text'		=> 'Good spot to lunch before #kitesurf #faro #algarve 🌊🌪🏄',
					 'likes'	=> '32'],
					['date'		=> Carbon::create(2016, 1, 23, 0)->diffForHumans(),
					 'pic'		=> 'img/insta/ferragudo.jpg',
					 'url'		=> 'https://www.instagram.com/p/BA38T_qlaKO/',
					 'loc_name' => 'Ferragudo Algarve Portugal',
					 'loc_url'	=> 'https://www.instagram.com/explore/locations/300122270/',
					 'text'		=> 'Bom dia #portimao',
					 'likes'	=> '14'],					 
		];

		//$dates = Carbon::create(2016, 2, 22, 0)->diffForHumans();      

	    return view('welcome', array('instas' => $instas ));

	}

}
