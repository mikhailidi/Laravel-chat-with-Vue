<aside class="column is-2 aside hero is-fullheight">
    <div>
        <new-conversation-modal></new-conversation-modal>
        <div class="main">
            <a href="{{ route('chat.index') }}" class="item {{ Nav::isRoute('chat.index') }}"><span class="icon"><i class="fa fa-envelope-o"></i></span><span class="name">Chat</span></a>
            <a href="{{ route('profile.index') }}" class="item {{ Nav::isRoute('profile.index') }}"><span class="icon"><i class="fa fa-user"></i></span><span class="name">Profile</span></a>
            <a href="{{ route('friends.index') }}" class="item {{ Nav::isRoute('friends.index') }}"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Friends</span></a>
            <a href="{{ route('users.all') }}" class="item {{ Nav::isRoute('users.all') }}"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Users</span></a>
        </div>
    </div>
</aside>