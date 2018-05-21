<nav class="navbar has-shadow">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">
                <img src="https://logofactory.40dollarlogo.com/images/logo.png" alt="">
            </a>

            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navMenu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        @username(Auth::user()->getUserName())
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('profile.index') }}">
                            Profile
                        </a>
                        <a class="navbar-item">
                            Elements
                        </a>
                        <a class="navbar-item">
                            Components
                        </a>
                        <hr class="navbar-divider">
                        <div class="navbar-item">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>