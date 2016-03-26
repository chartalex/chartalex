@extends('layouts.master')

@section('title', 'Panier')

@section('content')       


<br><br>

@if(!count($cart))
<div class="text-center">
	<p class="text-muted" style="font-size:15em; padding: 60px;">
		<i class="fa fa-frown-o"></i>
	</p>
    <p>My cart is empty :(</p>
  	<a href="{{url('/mclh')}}" class="">Back to the shop</a>
</div>
@else


				<span class="lead" style="padding-left: 10px;">
					<i class="fa fa-shopping-basket"></i> Cart 
				</span>
				<small>(<a href="/mclh/cart/destroy" class="text-muted">remove all</a>)</small>
				<br><br>

	            <div class="table-responsive">
		            <table class="table table-condensed">
		                <tbody>
		                    @foreach($cart as $item)
		                    <tr>
		                        <td>
		                            <a href="#">
		                            	<img width="50" height="50" alt="{{ $item->name }}" src="/img/mclh/shop/{{ $item->options->prefix }}-300-boite.png" style="margin:auto">
									</a>
		                        </td>
		                        <td>
		                            <p>{{$item->qty}} x {{$item->name}} {{--<a class="cart_quantity_delete" href="{{url("cart?remove=$item->id")}}"><small><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></small></a>--}}</p>
		                            <span class="small">Size {{$item->options->size}}</span>
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
							<td class="text-right">Shipping</td>
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


			<form action="/mclh/order" method="POST" data-toggle="validator" role="form" id="payment-form">


				<span class="lead" style="padding-left: 10px;">
					<i class="fa fa-truck"></i> Shipping information 
				</span>

				<br><br>

				<p class="small">
					Delivery takes usually between 2 and 15 days.<br>
					Yes I know it's vague. But it depends on where is the nearest post office on my road.<br>
				<br>

				{{-- Show $request errors after back-end validation --}}
				    @if($errors->has())
			          <div class="alert alert-danger fade in">
			              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			              <h4>The following errors occurred</h4>
			              <ul>
			                  @foreach($errors->all() as $error)
			                      <li>{{ $error }}</li>
			                  @endforeach
			              </ul>
			          </div>
					@endif


		    		<div class="row">
				        <div class="col-sm-6">
				            <input type="text" name="shipto_firstname" placeholder="Firstname" value="" class="form-control" required="required"/>
				        </div>
				        <div class="col-sm-6">
				            <input type="text" name="shipto_lastname" placeholder="Lastname" value="" class="form-control" required="required"/>
				        </div>
				    </div>

				    <br/>

				    <div class="row">
				        <div class="col-sm-12">
				            <input type="text" name="shipto_street" placeholder="Address" value="" class="form-control" required="required"/>
				        </div>
				    </div>

				    <br/>
				    
				    <div class="row">
				        <div class="col-sm-12">
				            <input type="text" name="shipto_street2" placeholder="Address details" value="" class="form-control"/>
				        </div>
				    </div>

				    <br/>

				    <div class="row">
				        <div class="col-sm-5">
				            <input type="text" name="shipto_zip" placeholder="Postal code" value="" class="form-control" required="required"/>
				        </div>
				        <div class="col-sm-7">
				            <input type="text" name="shipto_city" placeholder="City" value="" class="form-control" required="required"/>
				        </div>
				    </div>

				    <br/>

				    <div class="row">
				        <div class="col-sm-6">
				            <input type="text" name="shipto_country" placeholder="Country" value="" class="form-control" required="required"/>
				        </div>
				    </div>

				    <br>

				    <div class="row">
				        <div class="col-sm-6 small">
				        	<input type="checkbox" required="required"/> I accept the <a href="/mclh/terms">terms and conditions</a>.
				        </div>
				    </div>

				    <br>

				    <div class="row">
				        <div class="col-xs-6 small" style="padding-top: 6px;">
							< <a href="{{url('/mclh')}}" class="text-muted">Back to shop</a>
				        </div>
				        <div class="col-xs-6 text-right">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button id="payButton" type="submit" class="btn btn-primary">Pay with card <i class="fa fa-credit-card"></i></button>
  				        </div>
				    </div>



			</form>
	
@endif


			<br><br><br>

@endsection

@section('script')




<script src="https://checkout.stripe.com/checkout.js"></script>

   <script>
  var handler = StripeCheckout.configure({
    key: '{!! env('STRIPE_PK') !!}',
    image: '/img/mclh/mclh-logo.png',
    locale: 'auto',
    token: function(token) {
        // Insert the token into the form so it gets submitted to the server
        $('#payment-form').append($('<input type="hidden" name="stripeToken" />').val(token.id));
        $('#payment-form').append($('<input type="hidden" name="email" />').val(token.email));
        // and submit
        $('#payment-form').get(0).submit();
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
    }
  });



  $('#payment-form').on('submit', function(e) {
    // Open Checkout with further options
    handler.open({
      name: 'M. Chat L\'Heureux',
      description: '{{ Cart::count() }} products',
      currency: 'eur',
      allowRememberMe: 'false',
      amount: {{ (Cart::total() + $shipping)*100 }},
      @if (Auth::check())
      email: '{{ Auth::user()->email }}'
      @endif
    });
    e.preventDefault();
    return false;
  });

  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
  });
</script>

@endsection


