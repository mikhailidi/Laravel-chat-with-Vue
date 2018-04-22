<template lang="html">
<div class="card card-message">
    <div class="card-content">
        <div class="media">
            <div class="media-left">
                <figure class="image is-48x48">
                    <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                </figure>
            </div>
            <div class="media-content">
                <p class="title is-5">{{ message.user.first_name + ' ' + message.user.last_name}}</p>
                <p class="subtitle is-6">@{{ message.user.username }},
                    <small>{{ message.created_at }}</small>
                </p>
            </div>
        </div>
        <div class="msg-snippet"><p id="fake-snippet-1">{{ message.message }}</p></div>
    </div>
</div>
</template>

<script>
    export default {
//        data() {
//            return {
//                messages: {},
//            }
//        },
//        mounted() {
//            this.getMessages();
//        },
//        methods: {
//            getMessages() {
//                axios.get(this.$routes.route('message.index'))
//                    .then((response) => {
//                        this.messages = response.data;
//                        //this.scrollToEnd()
//                    })
//                    .catch(function (error) {
//                        console.log(error);
//                    });
//            }
//        },
        props: ['message']
    }
</script>