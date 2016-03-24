@extends('layouts.master')

@section('title', 'Admin')

@section('content')

<table class="table">
    <thead>
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Date</th>
        <th class="text-center">Nom</th>
        <th class="text-center">Prénom</th>
        <th class="text-center">Email</th>
        <th class="text-center">Montant</th>
        <th class="text-center">Status</th>
        <th class="text-center">Stripe</th>
      </tr>
    </thead>
     <tbody>
      @foreach ($orders as $order)
            <tr id="{{$order['order_id']}}" class="order-line">
              <td class="text-center"><a href="/mclh/order/{{$order->id}}" target="_blank">{{ $order->id }}</a></td>
              <td class="text-center">{{ $order->created_at }}</td>
              <td class="text-center">{{ $order->shipto_lastname }}</td>
              <td class="text-center">{{ $order->shipto_firstname }}</td>
              <td class="text-center">{{ $order->email }}</td>
              <td class="text-center">{{ $order->amount }} €</td>
              <td class="text-center">
                @if ($order->shipping_status =='shipped')
                  <span class="shipping-status" style="color:#2ecc71;">shipped</span>
                @else
                  <span class="shipping-status" style="color:#f1c40f;">pending</span><br/>
                  <a href="" class="update-shipping-status" order-id="{{$order->id}}">shipped</a>
                @endif
              </td>
              <td class="text-center">
                 <span style="color:#3498db;">{{ $order->stripe_transaction_id }}</span>
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>


@endsection

@section('script')

@endsection
