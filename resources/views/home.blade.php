@extends('layouts.chat')

@section('content')
   @include('chat.inbox-messages')




    <div class="column is-7 message hero is-fullheight" id="message-pane">
        <div class="action-buttons">
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-exclamation-circle"></i></a>
                <a class="button is-small"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
        <div class="box message-preview">
            <div class="top">
                <div class="avatar">
                    <img src="https://placehold.it/128x128">
                </div>
                <div class="address">
                    <div class="name">John Smith</div>
                    <div class="email">someone@gmail.com</div>
                </div>
                <hr>
                <div class="content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta magni officia quas quasi quis sint unde vero voluptas! Accusamus error iusto molestiae rem sequi? Alias aliquam consectetur iste quas similique.

                </div>
            </div>
        </div>
    </div>
@endsection
