<template lang="html">
<div>
    <div v-if="conversation">
        <div class="inbox-messages" id="chat-area">
            <div id="chat-list">
                <ChatList :chatItems="chatItems" :activeConversation="conversation.id"></ChatList>
            </div>
        </div>
        <hr>
        <send-message v-show="conversation"
                     :user="user"
                     :chatItems="chatItems"
                     :scrollToEnd="scrollToEnd"
                     :listen="listen"
                     :conversationId="conversation.id">
        </send-message>
    </div>
    <div v-else>
        <hr>
        <div class="notification is-warning">Please choose a conversation from the list</div>
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
                } else {
                    this.scrollToEnd();
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
                return this.chatItems.find(x => x.conversation_id === conversation_id);
            },
            addChatItem(chatItem) {
                if (!this.getChatItem(chatItem.conversation_id)) {
                    this.chatItems.push(chatItem);
                }
            },
            pushMessageToChat(message) {
                let chatItem = this.getChatItem(message.conversation_id);

                if (chatItem) {
                    chatItem.messages.push(message);
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
                        if (this.getChatItem(message.conversation_id)) {
                            this.pushMessageToChat(message);
                            this.scrollToEnd();
                        }
                    });
                Echo.private('private-message')
                    .listen('\\Modules\\Chat\\Events\\PrivateMessage', (message) => {
                        if (message.conversation.user_from === this.user.id ||  message.conversation.user_to === this.user.id) {
                            if (this.getChatItem(message.conversation_id)) {
                                this.pushMessageToChat(message);
                                this.scrollToEnd();
                            } else {
                                Vue.prototype.$eventBus.$emit('newConversation', message.conversation);
                            }
                        }
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