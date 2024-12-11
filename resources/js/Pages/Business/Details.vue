<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>
        <div class="container mt-8" v-else style="height:120vh;padding:0px 180px">
            <div class="row" style="height:200px">
                <div class="col-6 h-100">
                    <div class="row">
                        <div class="col-5 flex">
                            <img v-if="business?.logo" :src="business?.logo" class="border rounded-lg shadow-sm"
                                style="width:200px;height:200px;object-fit:cover;object-position:center">
                            <img v-else src="../images/no_image.png" class="border rounded-lg shadow-sm"
                                style="width:200px;height:200px;object-fit:cover;object-position:center">
                        </div>
                        <div class="col-7 flex flex-col justify-between">
                            <div>
                                <div class="h4 fw-bold">
                                    {{ business?.name }}
                                </div>
                                <div class="flex items-center" style="margin-top:-10px">
                                    <Stars />
                                    <span class="ms-1">{{ business?.ratings }}</span>
                                </div>
                                <div class="text-muted" style="font-weight:500">
                                    {{ business?.phone }}
                                </div>
                                <div class="text-muted" style="font-weight:500">
                                    {{ business?.address }}
                                </div>
                            </div>
                            <div class="flex flex-wrap">
                                <!-- <img src="https://cdn-icons-png.flaticon.com/128/1688/1688988.png" class="me-2"
                                    style="width:26px;height:26px"> -->
                                <span class="text-success fw-bold" :style="{ color: $themeColor }">
                                    Last updated on {{ business?.last_updated }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 h-100">
                    <Carousel v-if="business?.shop_images[0]" :images="business?.shop_images" />
                    <div class="border shadow-sm" v-else style="width:100%;height:200px;background-color:#ECECEE"></div>
                </div>
            </div>
            <div class="row mt-8">
                <div class="col-6">

                    <div class="row">
                        <div class="col-4">
                            <div class="rounded-lg border shadow flex justify-center items-center" style="height:160px">
                                <div class="text-center">
                                    <div class="anton-regular" style="font-size:70px" :style="{ color: $themeColor }">
                                        {{ today.getDate() }}
                                    </div>
                                    <div class="fw-bold fs-5" style="margin-top:-15px">
                                        {{ months[today.getMonth()] + ", " + today.getFullYear() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="rounded-lg border shadow p-3 flex flex-col justify-between"
                                style="height:160px">
                                <div>
                                    <div class="flex justify-between items-center" :style="{ color: $themeColor }">
                                        <div class="fw-bold">Reviews</div>
                                        <font-awesome-icon icon="fa-regular fa-comment" />
                                    </div>
                                </div>
                                <div class="fw-bold" style="font-size:50px">{{ formatNumber(business?.reviews_count) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="rounded-lg border shadow p-3 flex flex-col justify-between"
                                style="height:160px">
                                <div>
                                    <div class="flex justify-between items-center" :style="{ color: $themeColor }">
                                        <div class="fw-bold">Reviews</div>
                                        <font-awesome-icon icon="fa-regular fa-eye" />
                                    </div>
                                </div>
                                <div class="fw-bold" style="font-size:50px">{{
                                    formatNumber(business?.shop_views_count) }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <!-- google maps here -->
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import Carousel from '../Components/Carousel.vue';
import axios from 'axios';
import Carloader from '../Components/Carloader.vue';
import Stars from '../Components/Stars.vue';
import { onMounted, ref, inject } from 'vue';

const baseUrl = inject('baseUrl');

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

const loading = ref(false);
const business = ref(null);
const today = ref(new Date);

const props = defineProps({
    shop_id: Number
})

onMounted(() => {

    let token = localStorage.getItem('token');
    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.get(`${baseUrl}/shops/show?shop_id=${props.shop_id}`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            business.value = response.data.data;
            loading.value = false;

        }).catch((error) => {
            console.log(error);
            loading.value = false;

        })
})

const formatNumber = (num) => {
    if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
    }
    return num;
}

</script>

<style scoped>
.anton-regular {
    font-family: "Anton", sans-serif;
    font-weight: 400;
    font-style: normal;
}
</style>
