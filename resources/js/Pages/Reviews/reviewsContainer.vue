<template>
    <div class="w-full h-96">
        <div class="h-full p-2 overflow-scroll flex flex-col-reverse">
            <div v-for="(review, index) in reviews" :key="index">
                <review-item :review="review"/>
            </div>
        </div>
    </div>
</template>

<script>
import ReviewItem from "@/Pages/Reviews/reviewItem.vue";
export default {
    components: {ReviewItem},
    props: ['reviews']
}
</script>
