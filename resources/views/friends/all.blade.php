@extends('layouts.main')

@section('content')
    <h1 class="title is-1">All users list</h1>

    <div class="columns is-multiline is-mobile">
        @forelse($users as $user)
            <div class="column is-4">
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">{{ $user->getName() }}</p>
                                <p class="subtitle is-6">@johnsmith</p>
                            </div>
                        </div>

                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid assumenda at autem commodi, debitis distinctio dolor dolorum error impedit magnam perspiciatis quibusdam quisquam recusandae sequi sit, soluta voluptatibus voluptatum! Temporibus.
                            @if(!$user->findFriendById($user->getId()))
                                <form method="post" action="{{ route('friends.add') }}">
                                    {!! csrf_field() !!}
                                    <p>
                                        <input name="friend_id" type="hidden" value="{{ $user->getId() }}">
                                        <button type="submit" href="{{ route('friends.add') }}" class="button subtitle is-4 has-text-success">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="column">
                <h2 class="subtitle is-2 has-text-centered">You don't have friends yet</h2>
            </div>

        @endforelse
    </div>



    @if(count($users))
        <div class="columns">
            {{ $users->links('partials.paginator') }}
        </div>
    @endif

@endsection