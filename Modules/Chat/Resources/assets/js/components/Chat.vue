<template lang="html">
<div>
    <div class="inbox-messages" id="chat-area">
        <message v-for="message in messages" :message="message" :key="message.id"></message>
    </div>
    <send-message :user="user" :messages="messages" :scrollToEnd="scrollToEnd" :listen="listen"></send-message>
</div>
</template>

<script>
    import SendMessage from './SendMessage.vue';
    import Message from './Message.vue';

    export default {
        data() {
            return {
                messages: {}
            }
        },
        mounted() {
            this.getMessages();
            this.listen();
        },
        methods: {
            getMessages() {
                axios.get(this.$routes.route('message.index'))
                    .then((response) => {
                        this.messages = response.data;
                        this.scrollToEnd(true);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            scrollToEnd (isFirstTime = false) {
                let container = this.$el.querySelector("#chat-area");
                let scrollPos = container.scrollTop;
                let containerHeight = container.scrollHeight;

                // This if statement should be improved in feature
                if (isFirstTime || scrollPos < containerHeight - 100) {
                    window.setTimeout(function () {
                        container.scrollTop = container.scrollHeight;
                    }, 300);
                }
            },
            listen() {
                Echo.channel('public-channel')
                    .listen('\\Modules\\Chat\\Events\\NewMessage', (message) => {
                        this.messages.push(message);
                        this.scrollToEnd();
                    });
            }
        },
        components: {
            SendMessage,
            Message
        },
        props: ['user'],
    }
</script>