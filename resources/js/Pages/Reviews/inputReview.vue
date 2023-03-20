<template>
    <div class="relative h-10 m-1">
        <div style="border-top: 1px solid #e6e6e6" class="grid grid-cols-6">
            <input
                type="text"
                v-model="review"
                @keyup.enter="sendReview()"
                placeholder="add review..."
                class="col-span-5 outline-none p-1"
            />
            <button
                @click="sendReview()"
                class="place-self-end bg-gray-500 hover:bg-blue-700 rounded p-1 mt-1 text-white">
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: function (){
        return {
            review: ''
        }
    },
    methods: {
        sendReview() {
            if (this.review == ' '){
                return
            }
            axios.post('/review_send', {
                review: this.review
            })
                .then(response => {
                    if (response.status == 201){
                        this.review = '';
                        this.$emit('reviewsent');
                    }
                })
        }
    }

}
</script>
