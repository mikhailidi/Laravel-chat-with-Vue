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
                button: 'button is-danger',
                buttonText: 'Cancel',
                icon: 'fa fa-times'
          }
        },
        methods: {
            cancelUserRequest() {
                this.button += ' is-loading';
                axios.post(this.$routes.route('friends.requests.delete', {id: this.id})).then(response => {
                    if (response.status == 200) {
                        this.button = this.button.replace('is-loading', 'is-static').replace('is-danger', 'is-success');
                        this.icon = this.icon.replace('fa-times', 'fa-check');
                        this.buttonText = 'Request deleted';
                    }
                })
            }
        }
    }
</script>
