@extends('layouts.home_layout')
@section('title', __('Home'))
@push('css')
    <link rel="stylesheet" href="css/post-style.css">
@endpush
@section('content')
    <div class="postsBlock">
        @foreach ($data->original['data'] as $item)
            <div class="postBlock">
                @auth
                    @if (in_array(session('role'), ['editor', 'admin']))
                        <form class="postBlockForm">
                            <h3>{{ $item['title'] }}</h3>
                            <div>
                                <button formmethod="get" formaction="{{ route('posts.show.edit', $item['id']) }}">
                                    {{ __('Edit Post') }}</button>
                                    @method('delete')
                                    @csrf
                                <button formmethod="post" formaction="{{ route('posts.delete', $item['id']) }}">{{ __('Delete') }}</button>
                            </div>
                        </form>
                    @else
                        <h3>{{ $item['title'] }}</h3>
                    @endif
                    <hr>
                    <p>{!! substr(nl2br(e($item['content'])), 0, 400) !!} ... <a href="{{ route('posts.show', $item['id']) }}">{{ __('Read more') }}</a></p>
                @else
                    <h3>{{ $item['title'] }}</h3>
                    <hr>
                    <p>{!! substr(nl2br(e($item['content'])), 0, 150) !!} ... <a href="{{ route('login.index') }}">{{ __('Read more') }}</a></p>
                @endauth
                <p>{{__('Writed by ')}}  <b>{{$item['author']}}</b></p>
            </div>
        @endforeach
    </div>

@endsection
