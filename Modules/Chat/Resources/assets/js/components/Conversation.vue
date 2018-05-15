<template lang="html">
<div>
    <div class="inbox-messages" id="inbox-messages">
        <div  class="card" v-for="conversation in conversations" v-bind:class="{ active: activeConversation === conversation.id}">
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
                conversations: {},
                activeConversation: null
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
                this.activeConversation = conversation.id;

                // Using the event bus
                Vue.prototype.$eventBus.$emit('conversationSelected', conversation);
            }
        },
    }
</script>
