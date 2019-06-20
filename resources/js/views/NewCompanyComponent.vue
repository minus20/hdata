<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <input
                type="text"
                placeholder="Название"
                required
                v-model="name"
                class="form-control form-control-lg"
            >
        </div>
        <div class="form-group">
            <textarea
                placeholder="Описание"
                v-model="description"
                class="form-control form-control-lg"
            ></textarea>
        </div>
        <button type="submit" class="btn btn-secondary btn-lg">Отправить</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                description: ''
            };
        },
        methods: {
            submit() {
                this.$store.dispatch('addCompany', {
                    name: this.name,
                    description: this.description
                })
            }
        }
    }
</script>

<style scoped>

</style>
