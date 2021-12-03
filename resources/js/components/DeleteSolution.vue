<template>
    <a href="" @click="deleteSolution">Delete</a>

</template>

<script>
export default {
    props: ['solutionId'],

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
        deleteSolution() {
            axios.delete('/solutions/' + this.solutionId)
            .then( response => {
                //this.delta = 1;
                // this.status = ! this.status;
                console.log(response.data);
            });
        },
    },

    // computed: {
    //     totalVotes() {
    //         return Number(this.votes) - Number(this.myVote) + Number(this.delta);
    //     }
    // }
}
</script>
