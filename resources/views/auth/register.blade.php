@extends('layouts.login')
@section('title', 'Registration Form')
@section('content')
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Registration</h3>
                    <p class="subtitle has-text-grey">Please register new account to have an access to our features</p>
                    <div class="box" style="margin-top: 0;">
                        <form id="registration-form" method="POST" action="{{ route('register') }}" data-parsley-validate="">
                            {{ csrf_field() }}

                            <div class="field">
                                <div class="control">
                                    <input id="first_name" name="first_name" value="{{ old('first_name') }}" class="input is-large"
                                           type="text" placeholder="First Name" autofocus=""
                                           maxlength="20" required>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input id="last_name" name="last_name" value="{{ old('last_name') }}" class="input is-large"
                                           type="text" placeholder="Last Name"
                                           maxlength="36" required>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="field">
                                <div class="control">
                                    <input id="email" name="email" value="{{ old('email') }}" class="input is-large"
                                           type="email" placeholder="Your Email"
                                           data-parsley-type="email" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input id="username" name="username" value="{{ old('username') }}" class="input is-large"
                                           type="text" placeholder="@username('username (optional)')" maxlength="59">
                                    {{--{{ dump($errors) }}--}}
                                    @if ($errors->has('username'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input id="password" name="password" required class="input is-large" type="password"
                                           placeholder="Your Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input id="password-confirm" name="password_confirmation" class="input is-large" type="password"
                                           placeholder="Confirm password"
                                           data-parsley-equalto="#password" required>
                                    @if ($errors->has('confirm-password'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('confirm-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block has-text-danger">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-info is-large is-centered">Register</button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        Have an account ? <a class="has-text-link" href="{{ route('login') }}">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function () {
            $('#registration-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            });
        });
    </script>
@endsection
