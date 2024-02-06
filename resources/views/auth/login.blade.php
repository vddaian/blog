@extends('layouts.basic_layout')
@section('title', __('Login'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-style.css') }}">
@endpush
@section('content')
<div class="formBlock authForm">
    <form action="{{ route('login.verify') }}" method="post" class="authForm">
        @csrf
        <label for='name'>{{ __('Username') }}</label>
        <input type="text" name='name' required>
        <label for='password'>{{ __('Password') }}</label>
        <input type="password" name='password' required>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type='submit'>{{ __('Login') }}</button>
    </form>
    <form method="get" class="authForm" style="display: flex; flex-direction: row;">
        <button type='submit' formaction='{{ route('register.index') }}'>{{ __('Register') }}</button>
        <button style="margin-left: 10px" type='submit' formaction='{{ route('posts.index') }}'>{{ __('Enter like visitor') }}</button>
    </form>
</div>
@endsection
