<template>
    <div>
        <div class="">
            <img src="/svg/chevron-up.svg" @click="thumbsUp" width="20">
        </div>
        <div class="pt-2">
            <h4> {{ totalVotes }} </h4>
        </div>
        <div class="">
            <img src="/svg/chevron-down.svg" @click="thumbsDown" width="20">
        </div>
    </div>
</template>

<script>
export default {
    props: ['issueId', 'votes', 'myVote', 'type'],

    mounted() {
        console.log('Component mounted.')
    },

    data: function() {
        return {
            // status: this.votes,
            delta: this.myVote,
        }
    },


    methods: {
        thumbsUp() {
            axios.post('/' + this.type + '/' + this.issueId + '/like')
            .then( response => {
                this.delta = 1;
                // this.status = ! this.status;
                console.log(response.data);
            });
        },
        thumbsDown() {
            axios.post('/' + this.type + '/' + this.issueId + '/dislike')
            .then( response => {
                this.delta = -1;
                // this.status = ! this.status;
                console.log(response.data);
            });
        }
    },

    computed: {
        totalVotes() {
            return Number(this.votes) - Number(this.myVote) + Number(this.delta);
        }
    }
}
</script>
