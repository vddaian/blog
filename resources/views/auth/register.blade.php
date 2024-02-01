@extends('layouts.basic_layout')
@section('title', __('Login'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-style.css') }}">
@endpush
@section('content')
<div class="formBlock authForm">
    <form action="{{route('register.store')}}" method="post" class="authForm">
        @csrf
        <label for='name'>{{__('Username')}}</label>
        <input type="text" name='name' required>
        <label for='email'>{{__('Email')}}</label>
        <input type="text" name='email' required>
        <label for='password'>{{__('Password')}}</label>
        <input type="password" name='password' required>
        <label for='password_confirmation'>{{__('Password Confirm')}}</label>
        <input type="password" name='password_confirmation' required>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type='submit'>{{__('Register')}}</button>
    </form>
    <form method='get'>
    <button formaction='{{route('login.index')}}'>{{__('Login')}}</button>
    </form>
</div>
@endsection
