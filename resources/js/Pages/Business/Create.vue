<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>
        <div class="">
            <v-row class="flex justify-center items-center h-full">
                <v-col cols="9">

                    <v-row class="">
                        <v-col cols="6" class="">
                            <div class="d-flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၁</span>
                                <p class="text-danger ms-3">လုပ်ငန်းအချက်အလက်</p>
                            </div>

                            <img class=" w-100 h-50"
                                src="https://img-cdn.pixlr.com/image-generator/history/65bb506dcb310754719cf81f/ede935de-1138-4f66-8ed7-44bd16efc709/medium.webp"
                                alt="">

                        </v-col>

                        <v-col cols="6" class="mt-20">
                            <v-row class="information">
                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="me-5 w-36">လုပ်ငန်းနာမည်</span>
                                        <v-textarea label="" row-height="15" rows="1" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="me-5 w-36">ဖုန်းနံပါတ်</span>
                                        <v-textarea label="" row-height="15" rows="1" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="me-5 w-36">နေရပ်လိပ်စာ</span>
                                        <v-textarea label="" row-height="15" rows="1" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>


                            </v-row>

                            <v-row class="shop-opening-time">
                                <v-col cols="4">
                                    <div>
                                        <h3>ဆိုင်ဖွင့်ချိန်</h3>
                                    </div>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col col="12" class="d-flex justify-between items-center">
                                        <h3>ဆိုင်ဖွင့်ရက်များ</h3>
                                    <div class="flex justify-center items-center">
                                        <div class="chips d-flex">
                                            <span v-for="(day, index) in days" :key="day" @click="toggleDay(day)"
                                                style="cursor:pointer;border-radius:15px"
                                                :style="{ borderColor: $themeColor, backgroundColor: selectedDays.includes(index) ? $themeColor : '' }"
                                                :class="['w-12 h-10 border-2 p-2 me-3 flex justify-center items-center', selectedDays.includes(index) ? ['text-white font-bold'] : '']">{{
                                                    day }}</span>
                                        </div>
                                    </div>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" class="flex">
                                    <h3 class="my-5 w-50">လုပ်ငန်းအမျိုးအစား</h3>
                                    <div class="w-100">
                                        <v-select v-model="form.categories" :items="categories"
                                            label="လုပ်ငန်းအမျိုးအစားရွေးချယ်မည်" item-title="name" item-value="id"
                                            multiple persistent-hint></v-select>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>

                </v-col>

            </v-row>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import Carloader from '../Components/Carloader.vue'
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, inject } from 'vue';

const form = useForm({
    name: "",
    phone: "",
    address: "",
    opening_hour: "",
    closing_hour: "",
    opening_days: "",
    state_id: null,
    city_id: null,
    latitude: "",
    longitude: "",
    logo: null,
    categories: [],
    services: [],
    image: [],
    notes: [],
});

const loading = ref(false)
const baseUrl = inject('baseUrl');
const days = ref(['S', 'M', 'T', 'W', 'T', 'F', 'S'])
const selectedDays = ref([])
const categories = ref()

const toggleDay = (day) => {

    const dayIndex = days.value.indexOf(day);
    if (selectedDays.value.includes(dayIndex)) {
        selectedDays.value = selectedDays.value.filter(d => d !== dayIndex);
    } else {
        selectedDays.value.push(dayIndex);
    }
}


onMounted(() => {

    let token = localStorage.getItem('token');
    if (!token) {
        router.get('/login');
    }

    loading.vue = true;
    axios.get(`${baseUrl}/shops/categories`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            categories.value = response.data.data
            loading.value = false;

        }).catch((error) => {
            console.log(error);
            loading.value = false;

        })

})

</script>

<style lang="scss" scoped></style>
