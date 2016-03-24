@extends('layouts.master')

@section('title', 'Order success !')

@section('content')

{{-- Show $request errors after back-end validation 
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
      @endif
  </div>
--}}

<h2>Order success !</h2>

<p>Your payment has been accepted and your order will be shipped soon.</p>

<p>Thank you for your order.</p>

<p>This confirmation has been emailed to you.</p>

<p><i class="fa fa-home"></i><a href="/" class="text-muted"> Back to homepage</a></p>

@endsection

@section('script')

@endsection
