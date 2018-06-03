<template lang="html">
<section>
    <div class="inbox-messages" id="inbox-messages">
        <div  class="card" v-for="conversation in conversations" v-bind:class="{ active: activeConversation === conversation.id}">
            <div class="card-content" @click="conversationSelected(conversation)">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>
                    </div>

                    <div class="media-content">
                        <span class="msg-from">
                            <small>
                                {{ getConversationName(conversation) }}
                                <p v-if="conversation.to_user">
                                    @{{ conversation.to_user.username }}
                                </p>
                            </small>
                        </span>
                        <span class="msg-timestamp"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
    export default {
        data() {
            return {
                conversations: [],
                activeConversation: null
            }
        },
        mounted() {
            this.getConversations();
        },
        created() {
            Vue.prototype.$eventBus.$on('newConversation', (conversation) => {
                if (! this.conversations.find(x => x.id === conversation.id)) {
                    this.addNewConversation(conversation);
                }
            });
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
            getConversationName(conversation) {
                    if (conversation.name)
                        return conversation.name;
                    else if (conversation.to_user)
                        return conversation.to_user.first_name + ' ' + conversation.to_user.last_name;
                    else
                        return 'No name';

            },
            addNewConversation(conversation) {
                this.conversations.unshift(conversation);
            },
            conversationSelected(conversation) {
                this.activeConversation = conversation.id;

                // Using the event bus
                Vue.prototype.$eventBus.$emit('conversationSelected', conversation);
            }
        },
    }
</script>
