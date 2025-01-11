<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>

        <div class="mt-10">
            <v-row class="flex justify-center items-center h-full">
                <v-col cols="8" class="border-2 border-danger my-10">

                    <BackButton />
                    <v-row class="">
                        <v-col cols="5" class="">
                            <div class="d-flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၁</span>
                                <p class="text-danger ms-3 fs-5">လုပ်ငန်းအချက်အလက်</p>
                            </div>

                            <div class="flex items-center justify-center relative mx-14 rounded-md"
                                style="border:1px solid black;background-color:lightgray;width:200px;height:200px;">
                                <input type="file" id="fileUpload" class="absolute inset-0 opacity-0 cursor-pointer"
                                    @change="handleLogoFileChange" @input="form.logo = $event.target.files[0]" />

                                <label v-if="!form.logo" for="fileUpload"
                                    class="cursor-pointer text-center text-red-500 hover:text-red-700 flex flex-col items-center justify-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <span>Upload Logo</span>
                                </label>
                                <label for="fileUpload" class="absolute inset-0">

                                    <img v-if="logoPreview" :src="logoPreview" alt="Uploaded Image"
                                        class="object-cover w-full h-full" />

                                    <img v-else-if="form.logo" :src="form.logo" alt="Uploaded Image"
                                        class="object-cover w-full h-full" />

                                    <img v-else src="" alt="">

                                    <button v-if="form.logo" @click="clearImagePreview('logo')"
                                        class="absolute top-0 right-0 text-white px-2 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    </button></label>
                            </div>


                        </v-col>

                        <v-col cols="7" class="mt-24">
                            <v-row class="information">
                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="w-36">လုပ်ငန်းနာမည်</span>
                                        <v-textarea v-model="form.name" row-height="15" rows="1"
                                            :style="{ color: $themeColor }" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="w-36">ဖုန်းနံပါတ်</span>
                                        <v-textarea v-model="form.phone" row-height="15" rows="1"
                                            :style="{ color: $themeColor }" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="w-36">နေရပ်လိပ်စာ</span>
                                        <v-textarea label="" v-model="form.address" row-height="15" rows="1"
                                            :style="{ color: $themeColor }" variant="outlined"></v-textarea>
                                    </div>
                                </v-col>


                            </v-row>

                            <v-row class="shop-opening-time flex justify-between">
                                <v-col cols="12">
                                    <div>
                                        <v-row>
                                            <!-- Picker in Menu -->
                                            <v-col cols="12" sm="5" class=" position-relative">
                                                <h3 class="mb-5">ဆိုင်ဖွင့်ချိန်</h3>

                                                <div class="w-75" style="position:relative;">
                                                    <v-text-field class="" v-model="form.opening_hour" :active="menu"
                                                        :style="{ color: $themeColor }" :focus="menu"
                                                        label="Select Time" prepend-icon="mdi-clock-time-four-outline"
                                                        readonly>
                                                        <v-menu v-model="menu" :close-on-content-click="false"
                                                            activator="parent" transition="scale-transition">
                                                            <v-time-picker v-if="menu" v-model="form.opening_hour"
                                                                full-width format="ampm"></v-time-picker>
                                                        </v-menu>
                                                    </v-text-field>

                                                    <div class="bg-dark">
                                                        <div style="position: absolute; top:-10px;right:-60px;;">
                                                            <div class="my-1 fw-bold px-3"
                                                                @click="opening_time_format = 'AM'"
                                                                :class="opening_time_format == 'AM' ? 'bg-gray-300' : ''"
                                                                style="border-radius:7px;padding:6px;cursor:pointer">
                                                                AM
                                                            </div>
                                                            <div class="my-1 fw-bold px-3"
                                                                @click="opening_time_format = 'PM'"
                                                                :class="opening_time_format == 'PM' ? 'bg-gray-300' : ''"
                                                                style="border-radius:7px;padding:6px;cursor:pointer">
                                                                PM
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </v-col>

                                            <!-- Picker in Dialog -->
                                            <v-col cols="12" sm="5">
                                                <h3 class="mb-5">ဆိုင်ပိတ်ချိန်</h3>

                                                <div class="w-75" style="position:relative;">
                                                    <v-text-field class="" v-model="form.closing_hour" :active="menu2"
                                                        :style="{ color: $themeColor }" :focus="menu2"
                                                        label="Select Time" prepend-icon="mdi-clock-time-four-outline"
                                                        readonly>
                                                        <v-menu v-model="menu2" :close-on-content-click="false"
                                                            activator="parent" transition="scale-transition">
                                                            <v-time-picker v-if="menu2" v-model="form.closing_hour"
                                                                full-width format="ampm"></v-time-picker>
                                                        </v-menu>
                                                    </v-text-field>

                                                    <div class="bg-dark">
                                                        <div style="position: absolute; top:-10px;right:-60px;;">
                                                            <div class="my-1 fw-bold px-3"
                                                                @click="closing_time_format = 'AM'"
                                                                :class="closing_time_format == 'AM' ? 'bg-gray-300' : ''"
                                                                style="border-radius:7px;padding:6px;cursor:pointer">
                                                                AM
                                                            </div>
                                                            <div class="my-1 fw-bold px-3"
                                                                @click="closing_time_format = 'PM'"
                                                                :class="closing_time_format == 'PM' ? 'bg-gray-300' : ''"
                                                                style="border-radius:7px;padding:6px;cursor:pointer">
                                                                PM
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </v-col>
                                        </v-row>
                                    </div>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col col="12" class="d-flex justify-between items-center">
                                    <h3>ဆိုင်ဖွင့်ရက်များ</h3>
                                    <div class="flex justify-center items-center">
                                        <div class="chips d-flex">

                                            <span v-for="(day, index) in days" :key="day" @click="toggleDay(index)"
                                                style="cursor:pointer;border-radius:15px"
                                                :style="{ borderColor: $themeColor, backgroundColor: selectedDays.includes(index) ? $themeColor : '' }"
                                                :class="['w-11 h-10 border-2 p-2 me-3 flex justify-center items-center', selectedDays.includes(index) ? ['text-white font-bold'] : '']">{{
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
                                            :style="{ color: $themeColor }" label="လုပ်ငန်းအမျိုးအစားရွေးချယ်မည်"
                                            item-title="name" item-value="id" multiple persistent-hint></v-select>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>


                    <!-- 2 -->
                    <div class="location">
                        <v-row>
                            <div class="flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၂</span>
                                <p class="text-danger ms-3 fs-5">လုပ်ငန်းတည်နေရာ</p>
                            </div>
                        </v-row>

                        <v-row class="mx-14">
                            <v-col cols="6">

                                <select v-model="form.state_id" @change="getCity($event.target.value)" id=""
                                    :style="{ color: $themeColor }" class="form-control py-3">
                                    <option value="null">Choose a State</option>
                                    <option v-for="state in states" :key="state" :value="state.id">{{ state.name }}
                                    </option>
                                </select>
                            </v-col>


                            <v-col cols="6">
                                <v-select v-model="form.city_id" :items="cities.data" item-title="name" item-value="id"
                                    :style="{ color: $themeColor }" label="City"></v-select>
                            </v-col>
                        </v-row>

                        <v-row class="mx-16 my-5">
                            <v-textarea label="Location" v-model="location" row-height="15" rows="1"
                                :style="{ color: $themeColor }" variant="outlined"></v-textarea>
                        </v-row>
                    </div>

                    <!-- 3 -->
                    <div class="categories">
                        <v-row>
                            <div class="flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၃</span>
                                <p class="text-danger ms-3 fs-5">ကုန်ပစ္စည်းနှင့် ဝန်ဆောင်မှု အမျိုးအစားများ</p>
                            </div>
                        </v-row>

                        <div class="flex justify-end">
                            <CreateButton @click="addServiceBox" />
                        </div>

                        <v-row class="my-3 mx-14">
                            <v-col v-for="(box, index) in serviceBoxes" :key="index" cols="6">
                                <div
                                    class="border-2 border-danger flxex justify-center items-center position-relative p-5">
                                    <v-row class="flex">
                                        <v-col cols="4" class="flex justify-center items-center">
                                            <p>အမျိုးအစား</p>
                                        </v-col>

                                        <v-col>
                                            <select v-model="box.service_id"
                                                @click="getServiceItem($event.target.value, index)" id=""
                                                class="form-control w-full py-3">
                                                <option value="null">အမျိုးအစားရွေးချယ်မည်</option>
                                                <option v-for="service in services" :key="service" :value="service.id">
                                                    {{ service.name }}</option>
                                            </select>
                                        </v-col>
                                        <div>
                                            <DeleteButton @click="removeServiceItemBox(index)" />
                                        </div>
                                    </v-row>

                                    <v-row class="flex">
                                        <v-col cols="4" class="flex justify-center items-center">
                                            <p>ကုန်ပစ္စည်းများနှင့် ဝန်ဆောင်မှုများ</p>
                                        </v-col>


                                        <v-col>
                                            <v-select @update:model-value="addPrice(index)"
                                                v-model="box.items" :items="service_items[index]"
                                                label="ကုန်ပစ္စည်းများနှင့် ဝန်ဆောင်မှုများ‌ရွေးချယ်မည်"
                                                item-title="name" return-object multiple persistent-hint></v-select>
                                        </v-col>


                                    </v-row>

                                </div>
                            </v-col>


                        </v-row>

                    </div>

                    <!-- 4 price  -->
                    <div class="price">
                        <v-row>
                            <div class="flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၄</span>
                                <p class="text-danger ms-3 fs-5">စျေးနှုန်းသတ်မှတ်ရန်</p>
                            </div>
                        </v-row>

                        <v-row class="mx-14" v-if="serviceBoxes">
                            <v-col cols="6" v-for="(service, service_index) in serviceBoxes" :key="service_index">
                                <div class="row flex justify-between mt-5 mx-1 border py-3 rounded-lg">
                                    <span>
                                        {{ selectedService(service.service_id) }}
                                    </span>
                                    <div class="row" v-for="service_item, item_index in service.items"
                                        :key="item_index">
                                        <div class="col-md-8">
                                            <input disabled type="text" class="form-control my-2 py-3"
                                                :value="service_item.name">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control my-2 py-3"
                                                v-model="item_prices[service_index][item_index]">
                                        </div>
                                    </div>
                                </div>
                            </v-col>
                        </v-row>

                    </div>

                    <!-- images -->
                    <div class="images">
                        <v-row>
                            <div class="flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၅</span>
                                <p class="text-danger ms-3 fs-5">လုပ်ငန်းပုံများ</p>
                            </div>
                        </v-row>

                        <v-row>
                            <v-col cols="12" class="flex mx-16">


                                <label v-for="(image, index) in previewImages" :key="index">

                                    <!-- Render image preview -->

                                    <div class="relative">
                                        <img :src="image" class="object-cover w-full h-full me-3"
                                            style="width:150px;height:150px;border:2px solid red;border-radius: 10px;overflow:hidden;" />

                                        <!-- Button to remove image -->
                                        <button @click.prevent="clearImagePreview(image, index)"
                                            class="absolute top-0 right-2 text-black px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </label>


                                <div class="square-image flex justify-center items-center relative"
                                    style="width:150px;height:150px;border:2px solid red;border-radius: 10px;overflow:hidden;">
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer"
                                        @change="handleImageFileChange($event)" />


                                    <label for="fileImageUpload"
                                        class="cursor-pointer text-center text-red-500 hover:text-red-700 flex flex-col items-center justify-center space-y-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <span>Add Image</span>

                                    </label>

                                </div>

                            </v-col>
                        </v-row>
                        <div class="flex justify-center my-6">
                            <button class="text-white py-2 px-10 rounded-lg" :style="{ backgroundColor: $themeColor }"
                                @click="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </v-col>

            </v-row>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import Carloader from '../Components/Carloader.vue'
import CreateButton from '../Components/CreateButton.vue';
import BackButton from '../Components/BackButton.vue';
import DeleteButton from '../Components/DeleteButton.vue';
import { VTimePicker } from 'vuetify/labs/VTimePicker'
import { router, useForm } from '@inertiajs/vue3';
import { onMounted, ref, inject, watch } from 'vue';
import { split } from "postcss/lib/list";
import { useToast } from 'vue-toastification';

const props = defineProps({
    shop_id: Number
})

const business = ref()
const toast = useToast();
const loading = ref(false)
const baseUrl = inject('baseUrl');
const days = ref(['S', 'M', 'T', 'W', 'T', 'F', 'S'])
const selectedDays = ref([])
const categories = ref([])
const states = ref([])
const cities = ref([])
const location = ref()
const services = ref([])
const service_items = ref([])
const serviceBoxes = ref([])
const item_prices = ref([]);
const menu = ref(false);
const menu2 = ref(false);
const logoPreview = ref();
const filteredServices = ref()

const toggleDay = (dayIndex) => {
    if (selectedDays.value.includes(dayIndex)) {
        selectedDays.value = selectedDays.value.filter(d => d !== dayIndex);
    } else {
        selectedDays.value.push(dayIndex);
    }
}



const setLocation = () => {
    if (location?.value) {
        if (location.value.includes(',')) {
            let data = location.value.split(',');
            form.latitude = data[0];
            form.longitude = data[1].replace(/\s+/g, '');
        } else {
            toast.warning('Location format is wrong');
        }
    }
}

const previewImages = ref([])

onMounted(() => {

    const formatLocation = () => {
        if (business.value) {
            return business.value.latitude + ", " + business.value.longitude;
        }
        return "";
    };


    form.opening_days = selectedDays.value;

    let token = localStorage.getItem('token');
    if (!token) {
        router.get('/login');
    }

    const headers = {
        Authorization: `Bearer ${token}`
    };

    loading.value = true;

    const apiRequests = [
        axios.get(`${baseUrl}/shops/categories`, { headers }),
        axios.get(`${baseUrl}/getStates`, { headers }),
        axios.get(`${baseUrl}/shops/services`, { headers }),
        axios.get(`${baseUrl}/shops/show?shop_id=${props.shop_id}`, { headers })
    ];

    Promise.all(apiRequests)
        .then((response) => {
            console.log(response);
            categories.value = response[0].data.data;
            states.value = response[1].data.data;
            services.value = response[2].data.data;
            business.value = response[3].data.data;

            if (business.value) {
                Object.keys(form).forEach((key) => {
                    form[key] = business.value[key] ?? form[key];
                });

                console.log(form);

                if (form.opening_hour != null) {
                    form.opening_hour = change12hrFormat(form.opening_hour);
                }

                if (form.closing_hour != null) {
                    form.closing_hour = change12hrFormat(form.closing_hour);
                }

                form.shop_images.forEach(image => {
                    previewImages.value.push(image)
                })

                location.value = formatLocation();

                getCity(business.value?.state_id);
                form.city_id = business.value?.city_id;
            }

            business.value?.opening_days.forEach(day => {
                selectedDays.value.push(parseInt(day));
            })


            business.value?.services.forEach((service, index) => {

                getServiceItem(service.id, index);

                item_prices.value.push({});

                let items = [];
                service.items.forEach((item, itemIndex) => {
                    items.push(item);
                    item_prices.value[index][itemIndex] = item.price;
                })

                serviceBoxes.value.push({
                    service_id: service.id,
                    items: items
                });
            })

            loading.value = false;

        }).catch((error) => {
            console.log(error);
            loading.value = false;

        })
})

const form = useForm({
    shop_id: props.shop_id,
    name: "",
    phone: "",
    address: "",
    opening_hour: "",
    closing_hour: "",
    opening_days: [],
    state_id: null,
    city_id: null,
    latitude: "",
    longitude: "",
    logo: null,
    categories: [],
    services: [],
    shop_images: [],
    image: [],
    delete_images: [],
});


const selectedService = (serviceId) => {
    const service = services.value.find(service => service.id === serviceId);
    return service ? service.name : null;
}


const getCity = async (state_id) => {
    form.city_id = null;
    cities.value = await axios.get(`${baseUrl}/getCity?state_id=` + state_id);
};

const getServiceItem = async (serviceId, index) => {

    if (serviceId) {

        const duplicate = serviceBoxes.value.find((service, index, array) =>
            array.findIndex(item => item.service_id === service.service_id) !== index
        );

        if (duplicate) {
            toast.warning('အမျိုးအစားတူနေသောကြောင့် ထပ်မံရွေးချယ်ပါ');
            serviceBoxes.value[index].service_id = null;
            return;
        }


        let data = await axios.get(
            `${baseUrl}/shops/service_items/only_service_items?service_id=` + serviceId
        );


        service_items.value[index] = data.data;
    }

}

const change12hrFormat = (time) => {

    if (parseInt(split(time, ':')[0]) > 12) {
        return parseInt(split(time, ':')[0]) - 12 + ':' + split(time, ':')[1];
    } else {
        return parseInt(split(time, ':')[0]) + ':' + split(time, ':')[1];
    }

}


const change24hrFormat = (time, format) => {

    if (format == 'PM' && parseInt(split(time, ':')[0]) == 12) {
        time = parseInt(split(time, ':')[0]) + 12 + ':' + split(time, ':')[1];
    }
    if (format == 'PM') {
        time = parseInt(split(time, ':')[0]) + 12 + ':' + split(time, ':')[1];
    }
    return time + ':00';
}


const opening_time_format = ref('AM');
const closing_time_format = ref('PM');


const addServiceBox = () => {
    serviceBoxes.value.push({
        service_id: null,
        items: [],
    })
    item_prices.value.push({})
}

const addPrice = (index) => {
    let serviceItemIndex = serviceBoxes.value[index].items.length;
    item_prices.value[index][serviceItemIndex] = 0;
}

const removeServiceItemBox = (index) => {
    item_prices.value.splice(index, 1);
    serviceBoxes.value.splice(index, 1);
};


const handleLogoFileChange = () => {
    const file = event.target.files[0];

    if (file) {
        logoPreview.value = URL.createObjectURL(file);
    }
}

const handleImageFileChange = (event) => {
    const fileImage = event.target.files[0];
    if (fileImage) {
        form.image.push(fileImage);
        const previewUrl = URL.createObjectURL(fileImage);
        previewImages.value.push(previewUrl);
    }
}

const clearImagePreview = (from, index = null) => {
    if (from == 'logo') {
        logoPreview.value = null;
        form.logo = null;
    } else {

        if (previewImages.value[index] != null) {
            let imageName = previewImages.value[index].split('/').pop();
            if (!form.delete_images.includes(imageName)) {
                form.delete_images.push(imageName);
            }
            previewImages.value[index] = null;
            previewImages.value.splice(index, 1);
            form.shop_images[index] = null;
        }
    }

}

const submit = () => {


    if (form.opening_hour && form.closing_hour) {
        form.opening_hour = change24hrFormat(form.opening_hour, opening_time_format.value);
        form.closing_hour = change24hrFormat(form.closing_hour, closing_time_format.value);
    }


    form.opening_days = selectedDays.value;
    setLocation()

    form.services = serviceBoxes.value.map((service, serviceIndex) => ({
        ...service,
        items: service.items.map((item, itemIndex) => ({
            service_item_id: item.id,
            price: item_prices.value[serviceIndex][itemIndex],
            is_active: item.is_active
        }))
    }));


    let token = localStorage.getItem('token');

    axios.post(`${baseUrl}/shops/update`, form, {
        headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
        }
    }).then(response => {
        console.log(response.data.data);
        toast.success('Business updated successfully');
        router.replace('/dashboard');
    })

        .catch(error => {
            console.log(error);

        })
}


</script>

<style lang="scss" scoped></style>
