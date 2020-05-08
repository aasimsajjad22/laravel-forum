@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @forelse ($activities as $date => $activity)

            <h3 class="card-header">{{ $date }}</h3><br/>
            @foreach($activity as $record)
                @if(view()->exists("profiles.activities.{$record->type}"))
                    @include("profiles.activities.{$record->type}", ['activity' => $record])
                @endif

            @endforeach
            <br/>
        @empty
            <p>There is no activity for this user yet.</p>
        @endforelse

    </div>
@endsection
