@extends('chat::layouts.chat')

@section('content')
    @include('chat::inbox-messages')

    <div class="column is-7 message hero is-fullheight" id="message-pane">
        <div class="action-buttons">
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-inbox"></i></a>
                <a class="button is-small"><i class="fa fa-exclamation-circle"></i></a>
                <a class="button is-small"><i class="fa fa-trash-o"></i></a>
            </div>
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-exclamation-circle"></i></a>
                <a class="button is-small"><i class="fa fa-trash-o"></i></a>
            </div>
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-folder"></i></a>
                <a class="button is-small"><i class="fa fa-tag"></i></a>
            </div>
        </div>

        <div class="inbox-messages" id="chat-area">
            @for($i = 0; $i < 10; $i++)
            <div class="card card-message">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-5">John Smith</p>
                            <p class="subtitle is-6">@johnsmith</p>
                        </div>
                    </div>
                    {{--<div class="msg-header">--}}
                    {{--<div class="msg-subject"><span class="msg-subject"><strong id="fake-subject-1">Et ut quisquam ut earum qui voluptas duc</strong></span>--}}
                    {{--</div>--}}
                    <div class="msg-snippet"><p id="fake-snippet-1">Voluptatum assumenda unde ipsum doloribus suscipit.</p></div>
                </div>
            </div>
            @endfor
        </div>
        <div id="message-bla">
            <div class="control columns">
                <div class="column is-10">
                    <input class="input" type="text" placeholder="Normal input">
                </div>
                <div class="column is-2">
                    <a class="button is-primary is-rounded">Rounded</a>
                </div>
            </div>
        </div>
    </div>

@endsection
