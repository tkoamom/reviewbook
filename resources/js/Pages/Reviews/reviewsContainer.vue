<template>
    <div class="w-full">
        <div class="p-2 flex flex-col">
            <div style="display: flex; flex-direction: row">
                <div style="width: 300px">
                    <p style="font-size: 20px; font-weight: bold">Review</p>
                </div>
                <div style="width:300px">
                    <p style="font-size: 20px; font-weight: bold">Review Answer</p>
                </div>
            </div>
            <div v-for="(review, index) in reviews" :key="index">
                <review-item v-on:reviewAnswerSent="this.$emit('reviewAnswerSent')" :user="user" :review="review" :reviewAnswer="reviewAnswers.find(item => {return item.review_id === review.id})"/>
            </div>
        </div>
    </div>
</template>

<script>
import ReviewItem from "@/Pages/Reviews/reviewItem.vue";
export default {
    components: {ReviewItem},
    props: ['reviews', 'reviewAnswers', 'user']
}
</script>
