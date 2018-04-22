<template>
        <p>
            <a :class="button" @click.prevent="addFriend">
                <span class="icon is-small"><i :class="icon" aria-hidden="true"></i></span>
                <span> {{ buttonText }}</span>
            </a>
        </p>
</template>

<script>
    export default {
        props: ['friendId'],
        data: function () {
          return {
                button: 'button is-success',
                buttonText: 'Add friend',
                icon: 'fa fa-user-plus'
          }
        },
        methods: {
            addFriend() {
                this.button += ' is-loading';
                axios.post(this.$routes.route('friends.add', {id: this.friendId})).then(response => {
                    if (response.status == 200) {
                        this.button = this.button.replace('is-loading', 'is-static');
                        this.icon = this.icon.replace('fa-user-plus', 'fa-vcard-o');
                        this.buttonText = 'Request sent';
                    }
                })
            }
        }
    }
</script>
