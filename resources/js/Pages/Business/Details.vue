<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>
        <div class="container mt-8" v-else style="height:120vh;padding:0px 180px">
            <div class="flex justify-end my-2">
                <BackButton />
            </div>
            <div class="row" style="height:180px">
                <div class="col-6 h-100">
                    <div class="row">
                        <div class="col-4 rouned-lg">
                            <img v-if="business?.logo" :src="business?.logo" class="border rounded-lg shadow-sm"
                                style="width:180px;height:180px;object-fit:cover;object-position:center">
                            <img v-else src="../images/no_image.png" class="border rounded-lg shadow-sm"
                                style="width:200px;height:200px;object-fit:cover;object-position:center">
                        </div>
                        <div class="col-8 flex flex-col justify-between">
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
                            <div class="rounded-lg border shadow flex justify-center items-center"
                                style="height:130px;">
                                <div class="text-center">
                                    <div class="anton-regular fw-bold" style="font-size:70px"
                                        :style="{ color: $themeColor }">
                                        {{ today.getDate() }}
                                    </div>
                                    <div class="fw-bold fs-6" style="margin-top:-17px">
                                        {{ months[today.getMonth()] + ", " + today.getFullYear() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="rounded-lg border shadow p-3 flex flex-col justify-between"
                                style="height:130px;">
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
                                style="height:130px;">
                                <div>
                                    <div class="flex justify-between items-center" :style="{ color: $themeColor }">
                                        <div class="fw-bold">Views</div>
                                        <font-awesome-icon icon="fa-regular fa-eye" />
                                    </div>
                                </div>
                                <div class="fw-bold" style="font-size:50px">{{
                                    formatNumber(business?.shop_views_count) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-5">
                        <div class="chips d-flex">
                            <span v-for="(day, index) in days" :key="day" style="cursor:pointer;border-radius:15px"
                                :style="{ borderColor: $themeColor, backgroundColor: selectedDays.includes(index.toString()) ? $themeColor : '' }"
                                :class="['w-12 h-10 border-2 p-2 me-3 flex justify-center items-center', selectedDays.includes(index.toString()) ? ['text-white font-bold'] : '']">{{
                                    day }}</span>
                        </div>
                    </div>

                    <v-row>
                        <v-col cols="6">
                            <div class="border px-3 pt-2 pb-4 rounded-lg shadow-md">
                                <span class="font-bold" style="font-size:14px;"
                                    :style="{ color: $themeColor }">State</span>
                                <h1 class="fs-5 fond-bold">{{ business?.state_name }}</h1>
                            </div>
                        </v-col>
                        <v-col cols="6">
                            <div class="border px-3 pt-2 pb-4 rounded-lg shadow-md">
                                <span class="font-bold" style="font-size:14px;"
                                    :style="{ color: $themeColor }">City</span>
                                <h1 class="fs-5 fond-bold">{{ business?.city_name }}</h1>
                            </div>
                        </v-col>
                    </v-row>

                    <!-- Services -->
                    <v-row>
                        <v-col v-for="service in business?.services" cols="12">
                            <div class="border p-3 shadow-md" style="border-radius: 20px;">

                                <h3 class="font-bold fs-5">{{ service.name }}</h3>
                                <div v-for="item in service.items" class="flex justify-between p-2 my-2">
                                    <span>
                                        <font-awesome-icon v-if="item.is_active == true" icon="fa-solid fa-circle-check"
                                            class="text-success me-1" />

                                        <font-awesome-icon v-else icon="fa-solid fa-circle-minus"
                                            class="text-danger me-1" />

                                        {{ item.name }}</span>
                                    <p class="font-bold">{{ item.price }}</p>
                                </div>

                            </div>
                        </v-col>


                    </v-row>

                </div>
                <div class="col-6 mb-4 mt-3">
                    <!-- google maps here -->
                    <GoogleMap api-key="AIzaSyBqvZfzDW7YlZHtfaR-5l1v8f0YkMzswQM" style="width:100%;height:150px;"
                        :zoom="7" :center="center">
                        <Marker :options="{ position: center }"></Marker>
                    </GoogleMap>

                    <!-- Opening Hours -->
                    <div class="border rounded-md shadow-md p-3 mt-3">
                        <h4 class="font-semibold mb-2" style="font-size:13px;" :style="{ color: $themeColor }">Opening
                            Hours</h4>
                        <p class="mx-4 font-semibold" style="font-size:13px;">From <span class="font-bold fs-4">{{
                            change12hrsFormat(business?.opening_hour) }}</span> <span
                                class="mx-2 font-semibold">To</span> <span class="font-bold fs-4">{{
                                    change12hrsFormat(business?.closing_hour) }}</span></p>
                    </div>
                    <!-- Opening Hours -->

                    <!-- Business Types -->

                    <div class="border shadow-md my-3 p-2">
                        <v-row class="p-2">
                            <v-col v-for="(category, index) in business?.categories" :key="index" cols="4">
                                <div class="p-2 border shadow-md rounded-md">
                                    <h3 class="text-center font-semibold p-1">{{ category.name }}</h3>
                                </div>
                            </v-col>
                        </v-row>
                    </div>
                    <!-- Notes  -->
                    <div class="mt-4 p-2">
                        <div v-for="note in business?.shop_notes">
                            <h1 class="font-semibold fs-5">Notes</h1>
                            <p class="my-3"><font-awesome-icon icon="fa-solid fa-bullhorn"
                                    class="text-warning me-2 fs-5" />
                                {{ note.text }}</p>
                        </div>
                    </div>
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
import BackButton from '../Components/BackButton.vue';
import { onMounted, ref, inject } from 'vue';
import { defineComponent } from 'vue';
import { GoogleMap, Marker } from 'vue3-google-map';
const baseUrl = inject('baseUrl');

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

const loading = ref(false);
const business = ref(null);
const today = ref(new Date);

const props = defineProps({
    shop_id: Number
})
const center = ref({ lat: 0, lng: 0 });
const days = ref(['S', 'M', 'T', 'W', 'T', 'F', 'S'])
const selectedDays = ref([])

const change12hrsFormat = (time) => {
    if (time) {

        const [hour, minute] = time.split(':');
        let hours = parseInt(hour);
        let format = 'AM';

        if (hours >= 12) {
            format = 'PM';
            if (hours > 12) {
                hours -= 12;
            }
        } else if (hours === 0) {
            hours = 12;
        }
        return `${hours}:${minute} ${format}`
    }
}

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
            if (business.value) {
                selectedDays.value = business.value.opening_days;
                center.value = { lat: business.value.latitude, lng: business.value.longitude };
            }
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
