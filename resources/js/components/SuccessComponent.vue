<template>
    <div v-if="message" v-bind:class="'lead alert alert-' + type">
        {{ message }}
    </div>
</template>

<script>
    export default {
        name: "SuccessComponent",
        props: {
            message: '',
            type: {
                default: 'success'
            }
        }
    }
</script>

<style scoped>

</style>
