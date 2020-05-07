@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <h5>
                                    <a href="{{ route('profile', $thread->creator) }}">
                                        {{ $thread->creator->name }}
                                    </a>  posted {{$thread->title}}
                                </h5>
                            </span>
                            @can ('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-outline-danger">Delete Thread</button>
                            </form>
                            @endcan
                        </div>

                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
                <br>
                <div class="card">

                    @foreach($replies as $reply)
                        @include('threads.reply');
                    @endforeach

                </div>
                {{ $replies->links() }}
                <br/>
                @if(auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="body" placeholder="Have something to say?" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>

                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">Signin</a> to participate in forum discussion</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }}</p> by
                        <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }}
                        {{ Str::plural('comment', $thread->replies_count) }}
                    </div>
                </div>
            </div>
        </div>







    </div>
@endsection
