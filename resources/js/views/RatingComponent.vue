<template>
    <div>
        <div v-if="companies.length">
            <div v-for="company in companies" class="rating-company">
                <router-link :to="{name: 'company', params: {id: company.id}}" >
                    {{ company.name }}
                    <span class="float-right">
                        {{ parseFloat(company.average_rating).toFixed(1) }}
                    </span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            companies() {
                return this.$store.state.companies;
            }
        }
    }
</script>

<style scoped>

</style>
