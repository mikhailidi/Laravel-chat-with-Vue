@extends('layouts.main')

@section('content')
    <h1 class="title is-1">Your friends list</h1>

    <div class="columns is-multiline is-mobile">
        @forelse($friends as $friend)
            <div class="column is-half">
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{{ $friend->getUser()->getName() }}</strong>
                                    <br>
                                    <small>@johnsmith</small>
                                    <small>31m</small>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        @empty
            <div class="column">
                <h2 class="subtitle is-2 has-text-centered">You don't have friends yet</h2>
            </div>

        @endforelse

    </div>

    @if(count($friends))
        <div class="columns">
            {{ $friends->links('partials.paginator') }}
        </div>
    @endif

@endsection