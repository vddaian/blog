@extends('layouts.home_layout')
@section('title', __('Admin panel'))
@push('css')
    <link rel="stylesheet" href="/css/admin.css">
@endpush
@section('content')
    <div class="adminBlock">
        <ul>
            @foreach ($data->original['data'] as $item)
                @if ($item['name'] != session('username'))
                    <li>
                        <p>{{ $item['name'] }}</p>
                        <form>
                            @method('put')
                            <select name="role" id="role" value="{{ $item['role'] }}">     
                                @switch($item['role'])
                                    @case('writer')
                                        <option value="writer" selected>
                                            Writer
                                        </option>
                                        <option value="editor">
                                            Editor
                                        </option>
                                        <option value="subscriber">
                                            Subscriber
                                        </option>
                                    @break
                                    @case('editor')
                                        <option value="writer">
                                            Writer
                                        </option>
                                        <option value="editor" selected>
                                            Editor
                                        </option>
                                        <option value="subscriber">
                                            Subscriber
                                        </option>
                                    @break
                                    @case('subscriber')
                                        <option value="writer">
                                            Writer
                                        </option>
                                        <option value="editor">
                                            Editor
                                        </option>
                                        <option value="subscriber" selected>
                                            Subscriber
                                        </option>
                                    @break
                                    @default
                                @endswitch

                            </select>
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button formmethod="post" formaction="{{route('admin.update', $item['name'])}}" type="submit">{{ __('Update') }}</button>
                        </form>
                        <form action="{{route('admin.delete', $item['name'])}}" method="post">
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button>{{__('Delete')}}</button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection
