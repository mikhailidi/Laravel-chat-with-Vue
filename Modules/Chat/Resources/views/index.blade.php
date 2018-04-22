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

        <chat :user="{{ \Auth::user()->toJson() }}"></chat>
    </div>

@endsection
