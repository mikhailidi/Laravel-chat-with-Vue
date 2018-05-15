<template lang="html">
<div>
    <div v-if="conversation">
        <div class="inbox-messages" id="chat-area">
            <div id="chat-list">
                <ChatList :chatItems="chatItems" :activeConversation="conversation.id"></ChatList>
            </div>
        </div>
        <send-message v-show="conversation" :user="user" :chatItems="chatItems" :scrollToEnd="scrollToEnd" :listen="listen" :conversationId="conversation.id"></send-message>
    </div>
    <div v-else>
        <div class="notification is-info">Please choose a conversation from the list</div>
    </div>
</div>
</template>

<script>
    import SendMessage from './SendMessage.vue';
    import ChatList from './ChatList.vue';

    export default {
        data() {
            return {
                messages: null,
                conversation: null,
                chatItems: []
            }
        },
        mounted() {
            this.listen();
        },
        created() {
            Vue.prototype.$eventBus.$on('conversationSelected', (conversation) => {
                this.conversation = conversation;

                let chatItem = this.getChatItem(conversation.id);
                if (!chatItem) {
                    this.getMessages(conversation.id);
                }
            });
        },
        methods: {
            getMessages(conversation_id = 1) {
                this.messages = {};
                axios.get(this.$routes.route('message.index', {id: conversation_id}))
                    .then((response) => {
                        this.messages = response.data;

                        this.addChatItem({
                            conversation_id: conversation_id,
                            messages: this.messages
                        });
                        this.scrollToEnd(true);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getChatItem(conversation_id) {
//                console.log(this.chatItems.find(x => x.conversation_id === conversation_id));
                return this.chatItems.find(x => x.conversation_id === conversation_id);
            },
            addChatItem(chatItem) {
                if (!this.getChatItem(chatItem.conversation_id)) {
                    this.chatItems.push(chatItem);
                }
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
            ChatList
        },
        props: ['user'],
    }
</script>