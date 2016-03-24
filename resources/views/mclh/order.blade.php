@extends('layouts.master')

@section('title', 'Order')

@section('content')

<br>

<div class="small">
      <p>
        Date: {{ $order->created_at }}
      </p>
      <p>
        Email: {{ $order->email }}

      </p>

      <h3>Shipping information</h3>
      <strong>{{ $order->shipto_firstname }} {{ $order->shipto_lastname }}</strong><br/>
      {{ $order->shipto_street }}<br/>
      {{ strlen($order->shipto_street2 > 0) ? $order->shipto_street2.'<br/>': ''}}
      {{ $order->shipto_zip }} {{ $order->shipto_city }}<br/>
      {{ $order->shipto_country }}<br/>
</div>


<br/><br/><br/>



  <table class="table">
    <thead>
      <tr>
        <th class="text-center">Description</th>
        <th class="text-center">Taille</th>
        <th class="text-center">Quantité</th>
        <th class="text-right">Montant</th>
      </tr>
    </thead>
     <tbody>

    @foreach ($order_details as $product)
      <tr>
        <td class="text-center">{{ $product->name }}</td>
        <td class="text-center">{{ $product->size }}</td>
        <td class="text-center">{{ $product->qty }}</td>
        <td class="text-right">{{ $product->price }} €</td>
      </tr>
    @endforeach

    </tbody>
  </table>

  </br> 


  <div class="row">
    <div class="col-md-7"></div>
    <div class="col-md-4" style="border:solid 2px grey">
      <div class="row">
        <div class="col-md-6 palette-silver">Frais de port</div>  
        <div class="col-md-6 text-right">
          @if ( $order->shipping_fees > 0 )
            {{ $order->shipping_fees }} €
          @else
            offerts
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 palette-silver">Total</div>  
        <div class="col-md-6 text-right">{{ $order->amount }} €</div>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>




@endsection

@section('script')

@endsection
