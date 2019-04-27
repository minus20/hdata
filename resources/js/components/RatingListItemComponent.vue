<template>
    <a
        v-bind:href="'/companies/' + id"
        v-on:click.prevent="push"
        class="list-group-item">
        #{{ id }} {{ name }}
        <span class="badge badge-info float-right">{{ getCompanyRating(id) }}</span>
    </a>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        props: {
            id: Number,
            name: String
        },
        computed: {
            ...mapGetters([
                'getCompanyRating'
            ]),
        },
        methods: {
            push() {
                this.$router.push({name: 'company', params: {id: this.id}})
            }
        },
    }
</script>

<style scoped>

</style>
