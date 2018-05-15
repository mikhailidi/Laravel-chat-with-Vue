<template lang="html">
    <div id="message-bla">
        <div class="control columns">
            <div class="column is-10">
                <input class="input" type="text" @keyup.enter="postMessage" placeholder="Type your message here" v-model="messageBox">
            </div>
            <div class="column is-2">
                <button class="button is-primary is-rounded" :class="sendLoading" @click.prevent="postMessage" :disabled="!messageBox">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageBox: '',
                sendLoading: ''
            }
        },
        methods: {
            postMessage() {
                this.sendLoading = 'is-loading';

                axios.post(this.$routes.route('message.store', {
                    api_token: this.user.api_token,
                    message: this.messageBox,
                    conversation_id: this.conversationId
                }))
                    .then((response) => {
                        this.sendLoading = '';

                        let chatItem = this.chatItems.find(x => x.id === this.conversationId);
                        chatItem.messages.push(response.data);

                        this.messageBox = '';
                        this.scrollToEnd();
                    })
                    .catch(function (error) {
                        this.sendLoading = 'is-loading';
                        console.log(error);
                    });
            }
        },
        props: ['user', 'chatItems', 'scrollToEnd', 'conversationId']
    }
</script>
