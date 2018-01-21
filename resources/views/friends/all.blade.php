@extends('layouts.main')

@section('content')
    <h1 class="title is-1">All users list</h1>

    <div class="columns is-multiline is-mobile">
        @forelse($users as $user)
            <div class="column is-4">
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-96x96">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p>
                                <strong>{{ $user->getName() }}</strong>
                                <br>
                                <small>@johnsmith</small>
                            </p>
                            @if($user->checkOutgoingFriendRequest($user->getId()))
                                <p>
                                    <a class="button is-static">
                                        <span class="icon is-small"><i class="fa fa-vcard-o"></i></span>
                                        <span>Request sent</span>
                                    </a>
                                </p>
                            @elseif(!$user->checkFriendById($user->getId()))
                                <add-friend friend-id="{{ $user->getId() }}"></add-friend>
                            @else
                                <p>
                                    <a class="button is-static">
                                        <span class="icon is-small"><i class="fa fa-handshake-o"></i></span>
                                        <span>You are friends</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        @empty
            <div class="column">
                <h2 class="subtitle is-2 has-text-centered">Looks like we don't have users yet</h2>
            </div>
        @endforelse
        </div>



            @if(count($users))
                <div class="columns">
                    {{ $users->links('partials.paginator') }}
                </div>
    @endif

@endsection