<template>
    <div style="display: flex; flex-direction: row">
        <div style="width: 300px">
            {{review.message}}
        </div>
        <div style="width: 300px">
            {{reviewAnswer ? reviewAnswer.message : ''}}
        </div>
        <div v-if="(user.is_admin === 1) && !reviewAnswer">
            <input-review-answer :review="review" v-on:reviewAnswerSent="this.$emit('reviewAnswerSent')"/>
        </div>
    </div>
</template>

<script>
import InputReviewAnswer from "@/Pages/Reviews/inputReviewAnswer.vue";
export default {
    components: {InputReviewAnswer},
    props: ['review', 'reviewAnswer', 'user']
}
</script>
