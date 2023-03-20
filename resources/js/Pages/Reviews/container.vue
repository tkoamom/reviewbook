<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ReviewsContainer from "@/Pages/Reviews/reviewsContainer.vue";
import InputReview from "@/Pages/Reviews/inputReview.vue";
import {TailwindPagination} from "laravel-vue-pagination"
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reviews
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <reviews-container v-on:reviewAnswerSent="getReviewAnswers()" :reviews="reviews.data" :reviewAnswers="reviewAnswers" :user="user"/>
                    <tailwind-pagination :data="reviews" @pagination-change-page="getReviews"></tailwind-pagination>
                    <input-review
                        v-on:reviewsent="getReviews()"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    export default {
        data: function (){
            return {
                user: null,
                reviews: {},
                reviewAnswers: []
            }
        },
        methods: {
            connect(){
                let vm = this;
                window.Echo.private('reviews-channel')
                    .listen('NewReview', e => {
                        if (! ('Notification' in window)) {
                            alert('Web Notification is not supported');
                            return;
                        }
                        Notification.requestPermission( permission => {
                            let notification = new Notification('Awesome Website', {
                                body: e.review.id,
                                icon: "https://pusher.com/static_logos/320x320.png"
                            });
                            notification.onclick = () => {
                                window.open(window.location.href);
                            };
                        });
                        vm.getReviews();
                    });
            },
            getReviews(page=1) {
                axios.get(`/reviews_data?page=${page}`)
                    .then( response => {
                        this.reviews = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getReviewAnswers() {
                axios.get('/reviews_answers_data')
                    .then( response => {
                        this.reviewAnswers = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getUser() {
                axios.get('/user_data')
                    .then( response => {
                        this.user = response.data;
                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getUser();
            this.getReviews();
            this.getReviewAnswers();
            this.connect();

        }
    }
</script>
