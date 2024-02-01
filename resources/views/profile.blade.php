@extends('layouts.home_layout')
@section('title', __('Profile'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-style.css') }}">
@endpush
@section('content')
    <div class="formBlock authForm">
        <form action="{{ route('profile.update', $data->original['data'][0]['name']) }}" method="post" class="AuthForm">
            @method('put')
            <label for="name">{{ __('Username') }}</label>
            <input type="text" name="name" value="{{ $data->original['data'][0]['name'] }}" readonly>
            <label for="email">{{ __('Email') }}</label>
            <input type="text" name="email" value="{{ $data->original['data'][0]['email'] }}">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" placeholder="**********">
            <label for="password_confirmation">{{ __('Confirm password') }}</label>
            <input type="password" name="password_confirmation" placeholder="**********">
            <input type="hidden" name="id" value="{{ $data->original['data'][0]['id'] }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">{{ __('Update') }}</button>
        </form>
    </div>
@endsection
