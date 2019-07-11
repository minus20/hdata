<template>
    <div v-if="error" class="alert alert-danger">
        <h4 class="alert-heading">Ошибка</h4>
        <div v-for="(errors, fieldName) in error.errors">
            <p>{{fieldName | capitalize}}:</p>
            <ul v-for="error in errors">
                <li>{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ErrorComponent",
        props: ['error'],
        filters: {
            capitalize: function (value) {
                if (!value) return '';
                value = value.toString();
                return value.charAt(0).toUpperCase() + value.slice(1);
            }
        }
    }
</script>

<style scoped>

</style>
