<template lang="html">
<div>
    <div v-for="chatItem in chatItems" v-show="activeConversation == chatItem.conversation_id">
        <div class="notification is-info" v-if="!chatItem.messages.length">No messages in this conversation yet</div>
        <message v-for="message in chatItem.messages" :message="message" :key="message.id"></message>
    </div>
</div>
</template>

<script>
    import Message from './Message.vue';

    export default {
        components: {
            Message
        },
        props: ['chatItems', 'activeConversation']
    }
</script>