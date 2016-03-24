
@extends('layouts.master')

@section('title', 'Register')

@section('content')

@if ( isset($info) )
    <div class="alert alert-info" role="alert">
         {{ $info }}
    </div>
@endif

<br><br>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h3 class="">Register</h3>
            <p class="small">
                There is no password on this website :)<br>
                Just enter your email and we will send you a direct link to login.
            </p>
        </div>
    </div>

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" required="required"/>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-right">
            <button type="submit" class="btn btn-primary">Send me a direct link</button>
        </div>
    </div>

</form>

@endsection

@section('script')

@endsection