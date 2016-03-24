
@extends('layouts.master')

@section('title', 'Login')

@section('content')

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>

@endsection

@section('script')

@endsection