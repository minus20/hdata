<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h2>Rating</h2>
            </div>
            <div v-if="companies.length > 0">
                <div class="list-group">
                    <rating-list-item
                        v-for="company in companies"
                        v-bind:key="company.id"
                        v-bind:id="company.id"
                        v-bind:name="company.name"
                    ></rating-list-item>
                </div>
            </div>
            <div v-else class="card-body">
                <i>Loading...</i>
            </div>
        </div>
        <div v-if="signedIn">
            <button class="btn" v-on:click="showForm = !showForm">Заявка на добавление</button>
            <form v-if="showForm" v-on:submit.prevent="newCompany">
                <input type="text" v-model="name" placeholder="Name" required><br>
                <button class="btn">Send</button>
            </form>
        </div>
    </div>
</template>

<script>
    import RatingListItemComponent from "./RatingListItemComponent";

    export default {
        name: "RatingListComponent",
        data() {
            return {
                showForm: false,
                name: ''
            }
        },
        components: {
            'rating-list-item': RatingListItemComponent,
        },
        computed: {
            companies() {
                return this.$store.state.companies
            },
            signedIn() {
                return this.$store.state.profile.name
            }
        },
        methods: {
            newCompany() {
                this.$store.dispatch('addCompany', {name: this.name})
            }
        }
    }
</script>

<style scoped>

</style>
