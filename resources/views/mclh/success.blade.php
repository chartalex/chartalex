@extends('layouts.master')

@section('title', 'Order success !')

@section('content')

{{-- Show $request errors after back-end validation --}}
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


<h1>Commande confirmée</h1>

<p>Votre paiement a bien été accepté</p> 

<p> Status:</p>

@endsection

@section('script')

@endsection
