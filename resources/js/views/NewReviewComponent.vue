<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <label for="rating" class="lead">Рейтинг: {{ rating }}</label>
            <input
                id="rating"
                type="range"
                min="1"
                max="5"
                step="1"
                class="form-control-range"
                v-model="rating"
                required
            >
        </div>
        <div class="form-group">
            <label for="review" class="lead">Отзыв</label>
            <textarea
                id="review"
                class="form-control form-control-lg"
                v-model="comment"
                required
            ></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-secondary btn-lg">
                Отправить
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                rating: '5',
                comment: ''
            };
        },
        methods: {
            submit() {
                this.$store.dispatch('addReview', {
                    'company_id': this.$route.params.id,
                    'rating' : this.rating,
                    'comment' : this.comment
                }).then(() => {
                    this.$router.back();
                })
            }
        }
    }
</script>

<style scoped>
label {
    color: darkgray;
    font-size: 16px;
}
</style>
