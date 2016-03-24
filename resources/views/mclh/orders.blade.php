@extends('layouts.master')

@section('title', 'Admin')

@section('content')

<h3>Last orders</h3>

  @if (count($orders))

  <table class="table">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Date</th>
          <th class="text-center">Montant</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
       <tbody>
        @foreach ($orders as $order)
              <tr id="{{$order['order_id']}}" class="order-line">
                <td class="text-center"><a href="/mclh/order/{{$order->id}}" target="_blank">{{ $order->id }}</a></td>
                <td class="text-center">{{ $order->created_at }}</td>
                <td class="text-center">{{ $order->amount }} €</td>
                <td class="text-center">
                  @if ($order->shipping_status =='shipped')
                    <span class="shipping-status" style="color:#2ecc71;">shipped</span>
                  @else
                    <span class="shipping-status" style="color:#f1c40f;">pending</span><br/>
                  @endif
                </td>
              </tr>
        @endforeach
      </tbody>
    </table>

  @else

    <p>
      No order yet :(
    </p>
    <p>
      Place your first one on <a href="/mclh">the shop</a>.
    </p>

  @endif

@endsection

@section('script')

@endsection
