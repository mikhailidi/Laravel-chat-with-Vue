<aside class="column is-2 aside hero is-fullheight">
    <div>
        <new-conversation-modal></new-conversation-modal>
        <div class="main">
            <a href="{{ route('chat.index') }}" class="item active"><span class="icon"><i class="fa fa-envelope-o"></i></span><span class="name">Chat</span></a>
            <a href="{{ route('profile.index') }}" class="item"><span class="icon"><i class="fa fa-user"></i></span><span class="name">Profile</span></a>
            <a href="{{ route('friends.index') }}" class="item"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Friends</span></a>
            <a href="{{ route('users.all') }}" class="item"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Users</span></a>
            <a href="#" class="item"><span class="icon"><i class="fa fa-cog"></i></span><span class="name">Settings</span></a>
        </div>
    </div>
</aside>