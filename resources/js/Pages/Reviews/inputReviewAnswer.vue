<template>
    <div class="relative h-10 m-1">
        <div style="border-top: 1px solid #e6e6e6" class="grid grid-cols-6">
            <input
                type="text"
                v-model="reviewAnswer"
                @keyup.enter="sendReviewAnswer()"
                placeholder="add review answer..."
                class="col-span-5 outline-none p-1"
            />
            <button
                @click="sendReviewAnswer()"
                class="place-self-end bg-gray-500 hover:bg-blue-700 rounded p-1 mt-1 text-white">
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['review'],
    data: function (){
        return {
            reviewAnswer: ''
        }
    },
    methods: {
        connectPrivate(){
            window.Echo.private('review.'+ this.review.id)
                .listen('NewReviewAnswer', e => {
                    if (! ('Notification' in window)) {
                        alert('Web Notification is not supported');
                        return;
                    }
                    Notification.requestPermission( permission => {
                        let notification = new Notification('Review Answer Sent', {
                            body: e.review.id,
                            icon: "https://pusher.com/static_logos/320x320.png"
                        });
                        notification.onclick = () => {
                            window.open(window.location.href);
                        };
                    });
                });
        },
        sendReviewAnswer() {
            if (this.reviewAnswer == ' '){
                return
            }
            axios.post('/review_answer_send', {
                review: this.review,
                reviewAnswer: this.reviewAnswer
            })
                .then(response => {
                    if (response.status == 201){
                        this.connectPrivate();
                        this.reviewAnswer = '';
                        this.$emit('reviewAnswerSent');
                    }
                })
        }
    }

}
</script>
