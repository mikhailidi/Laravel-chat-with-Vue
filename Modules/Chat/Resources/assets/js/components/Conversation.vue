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
                                {{ conversation.user ? conversation.user.first_name + ' ' + conversation.user.last_name : conversation.name }}
                                <p v-if="conversation.user">
                                    @{{ conversation.user.username }}
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
                activeConversation: null,
                conversationUser: null
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

                        this.conversations.forEach(function (e) {
                            if (!e.to_user && !e.from_user) {
                                e.user = null;
                            } else if (e.to_user.id !== this.user.id) {
                                e.user = e.to_user;
                            } else if (e.from_user.id !== this.user.id) {
                                e.user = e.from_user;
                            }
                        }, this);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
//            getConversationUser(conversation) {
//                    if (conversation.type === 'public')
//                        return null;
//
//                    if (conversation.to_user.id !== this.user.id)
//                        return conversation.to_user;
//                    else if (conversation.from_user.id !== this.user.id)
//                        return conversation.to_user;
//                    else
//                        return null;
//            },
            addNewConversation(conversation) {
                this.conversations.unshift(conversation);
            },
            conversationSelected(conversation) {
                this.activeConversation = conversation.id;

                // Using the event bus
                Vue.prototype.$eventBus.$emit('conversationSelected', conversation);
            }
        },
        props: ['user']
    }
</script>
