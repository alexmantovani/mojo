<template>
    <div>
        <img :src="imageLink" @click="favoriteIssue" width="25">
    </div>
</template>

<script>
export default {
    props: ['issueId', 'favorite'],

    mounted() {
        console.log('Component mounted.')
    },

    data: function() {
        return {
            status: this.favorite,
        }
    },

    methods: {
        favoriteIssue() {
            axios.post(this.issueId + '/favorite')
            .then( response => {
                this.status = ! this.status;
                console.log(response.data);
            });
        }
    },

    computed: {
        imageLink() {
            return (this.status) ? "svg/favorite.svg" : "svg/not-favorite.svg";
        }
    }
}
</script>
