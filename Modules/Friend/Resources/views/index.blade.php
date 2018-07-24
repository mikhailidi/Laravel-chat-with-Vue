@extends('layouts.main')

@section('content')
    <div class="tabs is-large" id="tab_header">
        <ul>
            <li class="item is-active" data-option="1"><a>Friends</a></li>
            <li class="item" data-option="2"><a>Friends requests</a></li>
            <li class="item" data-option="3"><a>Outgoing requests</a></li>
        </ul>
    </div>
    <div id="tab_container">
        <div class="container_item is-active" data-item="1">
            <h4 class="title is-3">Your friends list</h4>
            <div class="columns is-multiline is-mobile">
                @forelse($friends as $friend)
                    <div class="column is-half">
                        <div class="box">
                            <article class="media">
                                <div class="media-left">
                                    <figure class="image is-96x96">
                                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ $friend->getUser()->getFullName() }}</strong>
                                            <br>
                                            <small>@username($friend->getUser()->getUserName())</small>
                                            <br>
                                            <small>Last seen: {{ $friend->getUser()->getLastLogin() }}</small>
                                        </p>
                                        <p>
                                            <a class="button is-link"><span class="icon is-small"><i
                                                            class="fa fa-comments-o"></i></span>
                                                <span>Start conversation</span>
                                            </a>
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
        </div>

        <div class="container_item" data-item="2">
            <h4 class="title is-3">Your friends requests</h4>
            <div class="columns is-multiline is-mobile">
                @forelse($friendRequests as $friendRequest)
                    <div class="column is-half">
                        <div class="box">
                            <article class="media">
                                <div class="media-left">
                                    <figure class="image is-96x96">
                                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ $friendRequest->getFromUser()->getFullName() }}</strong>
                                            <br>
                                            <small>@username($friendRequest->getFromUser()->getUserName())</small>
                                            <small>{{ $friendRequest->getFromUser()->getLastLogin() }}</small>
                                        </p>
                                        <p>
                                            <confirm-request id="{{ $friendRequest->getId() }}"></confirm-request>
                                            <cancel-request id="{{ $friendRequest->getId() }}"></cancel-request>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                @empty
                    <div class="column">
                        <h2 class="subtitle is-2 has-text-centered">You don't have friend requests</h2>
                    </div>
                @endforelse
            </div>

            @if(count($friendRequests))
                <div class="columns">
                    {{ $friendRequests->links('partials.paginator') }}
                </div>
            @endif

        </div>

        <div class="container_item" data-item="3">
            <h4 class="title is-3">Your outgoing friends requests</h4>
            <div class="columns is-multiline is-mobile">
                @forelse($outgoingRequests as $outgoingRequest)
                    <div class="column is-half">
                        <div class="box">
                            <article class="media">
                                <div class="media-left">
                                    <figure class="image is-96x96">
                                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ $outgoingRequest->getToUser()->getFullName() }}</strong>
                                            <br>
                                            <small>@username($outgoingRequest->getToUser()->getUserName())</small>
                                            <small>31m</small>
                                        </p>
                                        <p>
                                            <cancel-request id="{{ $outgoingRequest->getId() }}"></cancel-request>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                @empty
                    <div class="column">
                        <h2 class="subtitle is-2 has-text-centered">You don't have outgoing friend requests</h2>
                    </div>

                @endforelse
            </div>

            @if(count($outgoingRequests))
                <div class="columns">
                    {{ $outgoingRequests->links('partials.paginator') }}
                </div>
            @endif

        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#tab_header li.item').on('click', function () {
                let number = $(this).data('option');
                console.log(number);
                $('#tab_header li.item').removeClass('is-active');
                $(this).addClass('is-active');
                $('#tab_container .container_item').removeClass('is-active');
                $('div[data-item="' + number + '"]').addClass('is-active');
            });
        });
    </script>
@endsection

@section('css')
    <style>
        #tab_container .container_item {
            display: none;
        }

        #tab_container .container_item.is-active {
            display: block;
        }
    </style>
@endsection