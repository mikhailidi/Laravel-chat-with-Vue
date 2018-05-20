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

        <b-modal :active.sync="isCardModalActive" :width="840">
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">New message</p>
                </header>
                <div class="modal-card-body">
                    <b-field horizontal label="Find your friend">
                        <b-autocomplete
                                v-model="name"
                                placeholder="Type your friend's first name, last name, username or email"
                                :open-on-focus="true"
                                :data="data"
                                field="user.username"
                                :loading="isFetching"
                                @input="getFriends"
                                @select="option => selected = option"
                                maxlength="50">

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
                        <b-input type="textarea"></b-input>
                    </b-field>
                </div>
                <footer class="modal-card-foot">
                    <b-field position="is-centered">
                        <p class="control">
                            <button class="button is-primary" :disabled=" !selected && !message">
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
                isImageModalActive: false,
                isCardModalActive: false,
                data: [],
                name: '',
                selected: null,
                isFetching: false,
                message: ''
            }
        },
        methods: {
            getFriends: debounce(function () {
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
            }, 500)
        }
    }
</script>


<style>
    .dropdown-menu {
        display: block;
    }
</style>