<template>
    <a :class="button" @click.prevent="cancelUserRequest"><span class="icon is-small"><i :class="icon"></i></span>
        <span>{{ buttonText }}</span>
    </a>
</template>

<script>
    export default {
        props: ['id'],
        data: function () {
          return {
                button: 'button is-success',
                buttonText: 'Confirm',
                icon: 'fa fa-check'
          }
        },
        methods: {
            cancelUserRequest() {
                this.button += ' is-loading';
                axios.post(this.$routes.route('friends.requests.accept', {id: this.id})).then(response => {
                    console.log(response);
                    if (response.data.status == 'friend.added') {
                        this.button = this.button.replace('is-loading', 'is-static');
                        this.buttonText = 'Friend added';
                    }
                })
            }
        }
    }
</script>
