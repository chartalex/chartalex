@extends('layouts.master')

@section('title', 'Panier')

@section('content')       


<br><br>

	<div class="row">
		<div class="col-sm-6">

			@if(count($cart))

			<span class="lead" style="padding-left: 10px;">
				<i class="fa fa-shopping-basket"></i> Contenu de mon panier 
			</span>
			<small>(<a href="/cart/destroy" class="text-muted">vider</a>)</small>
			<br><br>

            <div class="table-responsive">
	            <table class="table table-condensed">
	                <tbody>
	                    @foreach($cart as $item)
	                    <tr>
	                        <td>
	                            <a href="#">
	                            	<img width="50" height="50" alt="{{ $item->name }}" src="img/mclh/shop/{{ $item->options->prefix }}-300-boite.png" style="margin:auto">
								</a>
	                        </td>
	                        <td>
	                            <p>{{$item->qty}} x {{$item->name}} {{--<a class="cart_quantity_delete" href="{{url("cart?remove=$item->id")}}"><small><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></small></a>--}}</p>
	                            <span class="small">Taille {{$item->options->size}}</span>
	                        </td>
	                        <td>
	                            <p class="text-right" style="padding-top:20px">{{$item->subtotal}} €</p>
	                        </td>
	                        <td class="text-right" style="padding-top:27px; padding-right: 10px;">
	                        </td>
	                    </tr>
	                    @endforeach
	                </tbody>
					<tfoot>
					<tr>
						<td></td>
						<td class="text-right">Livraison</td>
						<td class="text-right">5 €</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td class="text-right"><strong>Total<strong></td>
						<td class="text-right"><strong>{{ Cart::total() + $shipping }} €<strong></td>
						<td></td>
					</tr>
					</tfoot>
	    		</table>
	        </div>


			


			<br>


			<a href="/">< Continuer mes achats</a>



	        @else
	        <div class="text-center">
	        	<p class="text-muted" style="font-size:15em; padding: 60px;">
	        		<i class="fa fa-frown-o"></i>
	        	</p>
	            <p>Mon panier est vide :(</p>
	          	<a href="/" class="">Retour à l'accueil</a>
	        </div>
	        @endif

		</div>
		<div class="col-sm-6" style="border-left: 1px solid #ccc">

			<span class="lead" style="padding-left: 10px;">
				<i class="fa fa-truck"></i> Adresse de livraison 
			</span>

			<br><br>
	    		<div class="row">
			        <div class="col-sm-6">
			            <input type="text" name="shipto_firstname" placeholder="Prénom" value="" class="form-control" required="required"/>
			        </div>
			        <div class="col-sm-6">
			            <input type="text" name="shipto_lastname" placeholder="Nom" value="" class="form-control" required="required"/>
			        </div>
			    </div>

			    <br/>

			    <div class="row">
			        <div class="col-sm-12">
			            <input type="text" name="shipto_address" placeholder="Adresse" value="" class="form-control" required="required"/>
			        </div>
			    </div>

			    <br/>
			    
			    <div class="row">
			        <div class="col-sm-12">
			            <input type="text" name="shipto_address2" placeholder="Complément d'adresse" value="" class="form-control"/>
			        </div>
			    </div>

			    <br/>

			    <div class="row">
			        <div class="col-sm-5">
			            <input type="text" name="shipto_zipcode" placeholder="Code Postal" value="" class="form-control" required="required"/>
			        </div>
			        <div class="col-sm-7">
			            <input type="text" name="shipto_city" placeholder="Ville" value="" class="form-control" required="required"/>
			        </div>
			    </div>

			    <br/>

			    <div class="row">
			        <div class="col-sm-6">
			            <input type="text" name="shipto_country" placeholder="Pays" value="" class="form-control" required="required"/>
			        </div>
			    </div>

			    <br>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<a id="customButton" href="cart/charge" class="btn btn-success btn-lg pull-right"><i class="fa fa-credit-card"></i> Payer</a>


		</div>
	</div>


			




			

			<br><br><br>



@endsection

@section('script')

<script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
  var handler = StripeCheckout.configure({
    key: 'pk_test_mkDhORVsv9RENB4VzuCwo6I1',
    image: '/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
    }
  });

  $('#customButton').on('click', function(e) {
    // Open Checkout with further options
    handler.open({
      name: 'chartalex.fr',
      description: 'Monsieur Chat L\'Heureux',
      zipCode: true,
      currency: "eur",
      amount: {{ (Cart::total() + $shipping)*100 }}
    });
    e.preventDefault();
  });

  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
  });
</script>
@endsection


