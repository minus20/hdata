<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group">
            <label for="rating">Рейтинг</label>
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
            <label for="review">Отзыв</label>
            <textarea
                id="review"
                class="form-control"
                v-model="comment"
            ></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">
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
                })
            }
        }
    }
</script>

<style scoped>

</style>
