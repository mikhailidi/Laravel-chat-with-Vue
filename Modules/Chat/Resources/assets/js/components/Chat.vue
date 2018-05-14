<template lang="html">
<div>
    <div v-if="conversation">
        <div class="inbox-messages" id="chat-area">
            <div class="notification is-info" v-if="!messages.length">No messages in this conversation yet</div>
            <message v-for="message in messages" :message="message" :key="message.id"></message>
        </div>
        <send-message :user="user" :messages="messages" :scrollToEnd="scrollToEnd" :listen="listen" :conversationId="conversation.id"></send-message>
    </div>
    <div v-else>
        <div class="notification is-info">Please choose a conversation from the list</div>
    </div>
</div>
</template>

<script>
    import SendMessage from './SendMessage.vue';
    import Message from './Message.vue';

    export default {
        data() {
            return {
                messages: null,
                conversation: null
            }
        },
        mounted() {
            //this.getMessages();
            this.listen();
        },
        created() {
            Vue.prototype.$eventBus.$on('conversationSelected', (conversation) => {
                this.conversation = conversation;
                this.getMessages(conversation.id);
            });
        },
        methods: {
            getMessages(conversation_id = 1) {
                this.messages = {};
                axios.get(this.$routes.route('message.index', {id: conversation_id}))
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