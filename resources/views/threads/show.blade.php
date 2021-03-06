@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>

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

                        <replies @removed="repliesCount --" @added="repliesCount ++"></replies>

                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>This thread was published {{ $thread->created_at->diffForHumans() }}</p> by
                            <a href="#">{{ $thread->creator->name }}</a>,
                            and currently has <span v-text="repliesCount"></span>
                            {{ Str::plural('comment', $thread->replies_count) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
