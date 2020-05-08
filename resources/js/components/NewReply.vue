<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea
                    class="form-control"
                    name="body"
                    id="body"
                    placeholder="Have something to say?"
                    rows="5"
                    v-model="body"
                    required
                ></textarea>
            </div>
            <button
                type="submit"
                class="btn btn-primary"
                @click="addReply"
            >Post</button>
        </div>
        <div v-else>
            <p class="text-center">Please <a href="/login">Signin</a> to participate in forum discussion</p>
        </div>
    </div>

</template>
<script>
    export default {

        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .then( ({ data }) => {
                        this.body = '';
                        flash('Your reply has been posted');

                        this.$emit('created', data);
                    })
            }
        }

    }
</script>
