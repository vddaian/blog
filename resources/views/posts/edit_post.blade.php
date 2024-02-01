@extends('layouts.home_layout')
@section('title', __('Edit Post'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-style.css') }}">
@endpush
@section('content')
    <div class="formBlock">
        @if (isset($data->original['data'][0]))
            <form action="{{ route('posts.update', $data->original['data'][0]['id']) }}" method="post" class="globalForm">
                @method('put')
                <label for="title">{{ __('Title') }}</label>
                <input type="text" name="title" value="{{ $data->original['data'][0]['title'] }}">
                <label for="content">{{ __('Content') }}</label>
                <textarea name="content">{{ $data->original['data'][0]['content'] }}</textarea>
                <input type="hidden" name="id" value="{{ $data->original['data'][0]['id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit">{{ __('Update') }}</button>
            </form>
        @else
            {!! redirect()->route('posts.index') !!}
        @endif
    </div>
@endsection
