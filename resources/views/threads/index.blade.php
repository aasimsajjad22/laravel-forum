@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Forum Threads</h2>
                        </div>

                    </div>

                    <div class="card-body">
                        @forelse ($threads as $thread)
                            <article>
                                <div class="level">
                                    <h4 class="flex">
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
                                    </a>
                                </div>
                                <div class="body">{{ $thread->body }}</div>
                            </article>

                            <hr>
                        @empty
                            <p>There are no revelant results at this time !</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
