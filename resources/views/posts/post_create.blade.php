@extends('layouts.home_layout')
@section('title', __('New Post'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-style.css') }}">
@endpush
@section('content')
    <div class="formBlock">
        <form action="{{ route('posts.store') }}" method="post" class='globalForm'>
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title">
            <label for="content">{{ __('Content') }}</label>
            <textarea name="content"></textarea>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">{{ __('Create') }}</button>
        </form>
    </div>
@endsection
