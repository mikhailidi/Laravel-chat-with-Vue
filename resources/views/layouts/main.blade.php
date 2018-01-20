<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('partials.nav')
<div class="columns" id="mail-app">
    <aside class="column is-2 aside hero is-fullheight">
        <div>
            <div class="compose has-text-centered">
                <a class="button is-danger is-block is-bold">
                    <span class="compose">Compose</span>
                </a>
            </div>
            <div class="main">
                <a href="#" class="item active"><span class="icon"><i class="fa fa-inbox"></i></span><span class="name">Inbox</span></a>
                <a href="#" class="item"><span class="icon"><i class="fa fa-star"></i></span><span class="name">Starred</span></a>
                <a href="#" class="item"><span class="icon"><i class="fa fa-envelope-o"></i></span><span class="name">Sent Mail</span></a>
                <a href="#" class="item"><span class="icon"><i class="fa fa-folder-o"></i></span><span class="name">Folders</span></a>
            </div>
        </div>
    </aside>
    <div class="column is-4 messages hero is-fullheight" id="message-feed">
        <div class="action-buttons">
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-chevron-down"></i></a>
                <a class="button is-small"><i class="fa fa-refresh"></i></a>
            </div>
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-inbox"></i></a>
                <a class="button is-small"><i class="fa fa-exclamation-circle"></i></a>
                <a class="button is-small"><i class="fa fa-trash-o"></i></a>
            </div>
            <div class="control is-grouped">
                <a class="button is-small"><i class="fa fa-folder"></i></a>
                <a class="button is-small"><i class="fa fa-tag"></i></a>
            </div>
            <div class="control is-grouped pg">
                <div class="title">1-10 of 100</div>
                <a class="button is-link"><i class="fa fa-chevron-left"></i></a>
                <a class="button is-link"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="inbox-messages" id="inbox-messages">
            <div class="card">
                <div class="card-content">
                    <div class="msg-header">
                        <span class="msg-from"><small>From: mikhailidi.p@gmail.com </small></span>
                        <span class="msg-timestamp">1111-11-11</span>
                        <span class="msg-attachment"><i class="fa fa-paperclip"></i></span>
                    </div>
                    <div class="msg-subject">
                        <span class="msg-subject"><strong id="fake-subject-1"></strong></span>
                    </div>
                    <div class="msg-snippet">
                        <p id="fake-snippet-1">jkjnkjkjhkjhkjhkjhkjh</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column is-6 message hero is-fullheight" id="message-pane">
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
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <p>
                <strong>Bulma Templates</strong> by <a href="https://github.com/dansup">Daniel Supernault</a>. The source code is licensed
                <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
            </p>
            <p>
                <a class="icon" href="https://github.com/dansup/bulma-templates">
                    <i class="fa fa-github"></i>
                </a>
            </p>
        </div>
    </div>
</footer>
    <!-- Scripts -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.min.js" integrity="sha256-5CEXP4Sh+bwJYBngjYYh2TEev9kTDwcjw60jZatTHtY=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js" integrity="sha256-QHdJObhDO++VITP6S4tMlDHRWMaUOk+s/xWIRgF/YY0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js" integrity="sha256-4PIvl58L9q7iwjT654TQJM+C/acEyoG738iL8B8nhXg=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        window.inbox = {};
        window.paginate = {
            total: Math.random() * (54236 - 100) + 3
        }
        for (var i = 0; i <= 10; i++) {
            window.inbox[i] = {
                from : faker.name.findName(),
                timestamp: null,
                subject : faker.lorem.sentence().substring(0,40),
                snippet : faker.lorem.lines(),
                fullMail: window.faker.lorem.paragraphs(faker.random.number(40)),
                email : faker.internet.email()
            };
        }
        var inboxVue = new Vue({
            el: '#mail-app',
            data: {
                messages: window.inbox,
                paginate: {
                    pointer: {
                        start: 1,
                        end: 10
                    },
                    total: 100
                }
            },
            methods: {
                showMessage: function (msg, index) {
                    $('#message-pane').removeClass('is-hidden');
                    $('.card').removeClass('active');
                    $('#msg-card-'+index).addClass('active');
                    $('.message .address .name').text(msg.from);
                    $('.message .address .email').text(msg.email);
                    var msg_body = '<p>' +
                        msg.snippet +
                        '</p>' +
                        '<br>' +
                        '<p>' +
                        msg.fullMail +
                        '</p>';
                    $('.message .content').html(msg_body);
                }
            }
        });
    });
</script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
