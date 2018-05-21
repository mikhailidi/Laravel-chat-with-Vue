<template>
    <section>
        <div class="compose has-text-centered">
            <a @click.prevent="isCardModalActive = true" class="button is-danger is-block is-bold">
                <span class="compose">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    New message
                </span>
            </a>
        </div>

        <b-modal :active.sync="isCardModalActive" :width="1200" has-modal-card>
            <div class="modal-card" >
                <header class="modal-card-head">
                    <p class="modal-card-title">New message</p>
                </header>
                <div class="modal-card-body">
                    <b-field horizontal label="Friend">
                        <b-autocomplete
                                v-model="name"
                                placeholder="Type your friend's first name, last name, username or email"
                                :open-on-focus="true"
                                :data="data"
                                field="user.username"
                                :loading="isFetching"
                                @input="getFriends"
                                @select="option => friend = option">

                            <template slot-scope="props">
                                <div class="media">
                                    <div class="media-content">
                                        <h1>{{ props.option.user.first_name }} {{ props.option.user.last_name }}</h1>
                                        <small> @{{ props.option.user.username }} </small>
                                    </div>
                                </div>
                            </template>

                        </b-autocomplete>
                    </b-field>

                    <b-field horizontal label="Message">
                        <b-input v-model="message" placeholder="Type your message here" type="textarea"></b-input>
                    </b-field>
                </div>
                <footer class="modal-card-foot">
                    <b-field position="is-centered">
                        <p class="control">
                            <button @click.prevent="sendMessage" class="button is-primary" :disabled="isButtonDisabled">
                                Send message
                            </button>
                        </p>
                    </b-field>
                </footer>
            </div>

        </b-modal>
    </section>
</template>

<script>
    import debounce from 'lodash/debounce'

    export default {
        data() {
            return {
                isCardModalActive: false,
                data: [],
                name: '',
                friend: null,
                isFetching: false,
                message: null
            }
        },
        computed: {
            isButtonDisabled() {
                return !(this.friend && this.message);
            }
        },
        methods: {
            getFriends: debounce(function () {
                if (!this.name)
                    return;

                this.data = [];
                this.isFetching = true;

                axios.get(this.$routes.route('friends.search', {keyword: this.name}))
                    .then(({data}) => {
                        data.results.forEach((item) => this.data.push(item));
                        this.isFetching = false;
                    })
                    .catch((error) => {
                        this.isFetching = false;
                        throw error
                    })
            }, 500),
            sendMessage() {
                axios.post(this.$routes.route('conversation.store', {
                    friend: JSON.stringify(this.friend),
                    message: this.message
                }))
                    .then((response) => {
                        this.isCardModalActive = false;
                        this.message = '';
                        this.name = '';
                        this.friend = null;
                        this.success();
                })
                    .catch((error) => {
                        console.log(error);
                });
            },
            success() {
                this.$toast.open({
                    message: 'Message has been sent',
                    type: 'is-success'
                })
            },
        },
    }
</script>
