<aside class="column is-2 aside hero is-fullheight">
    <div>
        <div class="compose has-text-centered">
            <a class="button is-danger is-block is-bold">
                <span class="compose">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    New message
                </span>
            </a>
        </div>
        <div class="main">
            <a href="#" class="item active"><span class="icon"><i class="fa fa-envelope-o"></i></span><span class="name">Chat</span></a>
            <a href="{{ route('profile.index') }}" class="item"><span class="icon"><i class="fa fa-user"></i></span><span class="name">Profile</span></a>
            <a href="{{ route('friends.index') }}" class="item"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Friends</span></a>
            <a href="{{ route('users.all') }}" class="item"><span class="icon"><i class="fa fa-group"></i></span><span class="name">Users</span></a>
            <a href="#" class="item"><span class="icon"><i class="fa fa-cog"></i></span><span class="name">Settings</span></a>
        </div>
    </div>
</aside>