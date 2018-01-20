@extends('layouts.login')

@section('content')
<section class="hero is-success is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Login</h3>
                <p class="subtitle has-text-grey">Please login to proceed.</p>
                <div class="box">
                    <figure class="avatar">
                        <img src="https://placehold.it/128x128">
                    </figure>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="control">
                                <input id="email" name="email" value="{{ old('email') }}" class="input is-large" type="email" placeholder="Your Email" autofocus="">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input id="password" name="password" required class="input is-large" type="password" placeholder="Your Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="button is-block is-info is-large">Login</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="{{ route('register') }}">Sign Up</a> &nbsp;·&nbsp;
                    <a href="{{ url('/password/reset') }}">Forgot Password</a>
                </p>
            </div>
        </div>
    </div>
</section>
    <style>
        .hero.is-success {
            background: #F2F6FA;
        }
        .hero .nav, .hero.is-success .nav {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .box {
            margin-top: 5rem;
        }
        .avatar {
            margin-top: -70px;
            padding-bottom: 20px;
        }
        .avatar img {
            width: 128px;
            padding: 5px;
            background: #fff;
            border-radius: 50%;
            -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
            box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
        }
        input {
            font-weight: 300;
        }
        p {
            font-weight: 700;
        }
        p.subtitle {
            padding-top: 1rem;
        }
    </style>
@endsection
