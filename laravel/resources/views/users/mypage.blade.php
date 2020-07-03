@extends('app')
@section('title', 'マイメッセージ')
@include('nav')

@section('content')

            <div class="container">
            @if (count($boards) > 0)
                <div class="row">
                    @foreach ($boards as $board)
                        <div class="col-sm-6 col-lg-4">
                            <a href="{{ route('messages',$board->id) }}">
                                <h3 class="title">{{ $board->otherUser->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
        <div class="row">
        <p>まだメッセージはありません</p>
        </div>

        @endif

        @endsection