<template>
    <div v-if="review && user" class="mb-3 review-container">
        <div class="row">
            <div class="col-2">
                Foto
            </div>
            <div class="col-8">
                <div>
                    {{ user.name }} опубликовал(а)
                </div>
                <div>
                    {{ getFormattedDate(review.updated_at) }}
                </div>
            </div>
            <span class="float-right">{{ parseFloat(review.rating).toFixed(1) }}</span>
        </div>
        <div class="review-body">
            {{ review.comment }}
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
            }
        },
        methods: {
            getFormattedDate(dateTime) {
                moment.locale('ru');
                let time = moment(dateTime);
                return time.format('MMM YYYY г.');
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
