@extends('layouts.home_layout')
@section('title', __('Post'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/post-style.css') }}">
@endpush
@section('content')
    <div class="postBlock">
        <div class="postInfoBlock">
            @if (isset($data->original['data'][0]))
            <h2>{{ $data->original['data'][0]['title'] }}</h2>
            <hr>
            <p>{!! nl2br(e($data->original['data'][0]['content'])) !!}</p>
            @else
                {!!redirect()->route('posts.index')!!}
            @endif
            
        </div>
    </div>
@endsection
