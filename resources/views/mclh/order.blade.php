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
        <th class="text-center">Product</th>
        <th class="text-center">Size</th>
        <th class="text-center">Quantity</th>
        <th class="text-right">Price</th>
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

    <tfoot>
      <tr>
        <td></td>
        <td></td>
        <td class="text-right">Shipping</td>
        <td class="text-right">
          @if ( $order->shipping_fees > 0 )
            {{ $order->shipping_fees }} €
          @else
            free
          @endif
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="text-right">
          <strong>Total</strong>
        </td>
        <td class="text-right">
          <strong>{{ $order->amount }} €</strong>
        </td>
      </tr>
    </tfoot>
  </table>

  </br> 

  <p class="small">
    Total amount include {{ number_format((float) ($order->amount - $order->shipping_fees)*0.2, 2) }} € of french taxes (VAT 20%).
  </p>

  <p class="small">
    < <a href="/mclh/order" class="text-muted"> Back to all orders</a>
  </p>


@endsection

@section('script')

@endsection
