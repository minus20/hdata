<template>
    <div v-if="review && user" class="mb-3 review-container">
        <div class="row mb-3">
            <div class="col-1">
                <span class="avatar" v-if="user.avatar">
                        <img v-bind:src="user.avatar">
                </span>
                <span class="avatar" v-else>
                        <img src="images/avatar-placeholder.png">
                </span>
            </div>
            <div class="col-11">
                <span class="float-right">{{ parseFloat(review.rating).toFixed(1) }}</span>
                <div>
                    {{ user.name }} опубликовал(а)
                </div>
                <div>
                    {{ getFormattedDate(review.updated_at) }}
                </div>
            </div>
        </div>
        <div class="review-body">
            {{ review.comment }}
        </div>
        <div v-if="isAdmin">
            <button class="btn btn-sm btn-danger" @click="deleteReview">Удалить отзыв</button>
        </div>
        <div class="bottom-block"></div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: {
            review: Object
        },
        computed: {
            user() {
                return this.$store.state.users.find(user => user.id == this.review.user_id)
            },
            isAdmin() {
                return this.$store.getters.isAdmin;
            }

        },
        methods: {
            getFormattedDate(dateTime) {
                moment.locale('ru');
                let time = moment(dateTime);
                return time.format('MMM YYYY г.');
            },
            deleteReview() {
                this.$store.dispatch('deleteReview', {id: this.review.id});
            }
        }
    }
</script>

<style scoped>
.review-container {
    border: 1px solid #dededc;
    padding: 15px 15px 0;
    color: darkgray;
}
.review-body {
    color: #333;
}
.bottom-block {
    height: 50px;
    background: #dededc;
    margin: 15px -15px 0;
}
</style>
