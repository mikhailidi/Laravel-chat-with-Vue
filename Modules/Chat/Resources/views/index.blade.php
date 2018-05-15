@extends('chat::layouts.chat')

@section('content')
    @include('chat::inbox-messages')

    <div class="column is-7 message hero is-fullheight" id="message-pane">
        <chat :user="{{ \Auth::user()->toJson() }}"></chat>
    </div>

@endsection
