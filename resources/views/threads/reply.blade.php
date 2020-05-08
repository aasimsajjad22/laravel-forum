<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{$reply->id}}" class="card">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
                said {{ $reply->created_at->diffForHumans() }}
                </h5>

                @if (Auth::check())
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-outline-primary btn-sm mr-2" @click="update">Update</button>
                <button class="btn btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else>
                <p class="card-text" v-text="body"></p>
            </div>
        </div>

        @can ('update', $reply)
            <div class="card-footer level">
                <button class="btn btn-outline-dark btn-sm mr-2" @click="editing = true">Edit</button>
                <button type="submit" class="btn btn-outline-danger btn-sm" @click="destroy">Delete</button>

            </div>
        @endcan
    </div>



</reply>
