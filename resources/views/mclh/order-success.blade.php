@extends('layouts.master')

@section('title', 'Order success !')

@section('content')

  <div class="col-md-6 col-md-offset-3">
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

      @else
        <h2>Order success !</h2>

        <p>Your payment has been accepted and your order will be shipped soon.</p>

        <p>Thank you <i class="fa fa-hand-peace-o"></i></p>
      @endif

      <p class="small">
        <i class="fa fa-home"></i><a href="/" class="text-muted"> Back to homepage</a>
      </p>

  </div>


@endsection

@section('script')

@endsection
