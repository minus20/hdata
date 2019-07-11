<template>
    <div>
        <a href="#" @click="$router.back()" class="btn btn-secondary">Назад</a>
        <form v-on:submit.prevent="submit">
            <h1>Запрос на добавление компании</h1>
            <success-component v-bind:message="message"></success-component>
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
            <error-component v-bind:error="error"></error-component>
            <button type="submit" v-bind:disabled="disabled" class="btn btn-secondary btn-lg">Отправить</button>
        </form>
    </div>
</template>

<script>
    import ErrorComponent from "../components/ErrorComponent";
    import SuccessComponent from "../components/SuccessComponent";
    export default {
        components: {SuccessComponent, ErrorComponent},
        data() {
            return {
                name: '',
                description: '',
                message: '',
                disabled: false,
                error: null,
            };
        },
        methods: {
            submit() {
                this.error = null;
                this.disabled = true;
                this.message = '';
                this.$store.dispatch('addCompany', {
                    name: this.name,
                    description: this.description
                }).then(() => {
                    this.message = 'Запрос отправлен. Ваша заявка будет рассмотрена администратором.';
                }).catch(error => {
                    this.error = error.response.data;
                }).finally(() => this.disabled = false );
            }
        }
    }
</script>

<style scoped>

</style>
