<template lang="html">
<div>
    <div class="inbox-messages" id="inbox-messages">
        <div  class="card" :class="conversation.active" v-for="conversation in conversations">
            <div class="card-content" @click="conversationSelected(conversation)">
                <div class="msg-header"><span class="msg-from"><small>{{ conversation.name }}</small></span> <span
                            class="msg-timestamp"></span></div>
                <div class="msg-subject"><span class="msg-subject"><strong id="fake-subject-1"></strong></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                conversations: {}
            }
        },
        mounted() {
            this.getConversations();
        },
        methods: {
            getConversations() {
                axios.get(this.$routes.route('conversation.index'))
                    .then((response) => {
                        this.conversations = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            conversationSelected(conversation) {
                // Using the event bus
                Vue.prototype.$eventBus.$emit('conversationSelected', conversation);
            }
        },
    }
</script>
