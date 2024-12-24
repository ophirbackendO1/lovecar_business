<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>
        <div class="">
            <v-row class="flex justify-center items-center h-full">
                <v-col cols="8" class="border-2 border-danger">

                    <v-row class="">
                        <v-col cols="6" class="">
                            <div class="d-flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၁</span>
                                <p class="text-danger ms-3 fs-5">လုပ်ငန်းအချက်အလက်</p>
                            </div>

                            <img class=" w-60 h-60 mx-20 mt-2"
                                src="https://img-cdn.pixlr.com/image-generator/history/65bb506dcb310754719cf81f/ede935de-1138-4f66-8ed7-44bd16efc709/medium.webp"
                                alt="">

                        </v-col>

                        <v-col cols="6" class="mt-24">
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
                                            label="လုပ်ငန်းအမျိုးအစားရွေးချယ်မည်" item-title="name" item-value="id"
                                            multiple persistent-hint></v-select>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>

                    <!-- 2 -->
                    <div class="">
                        <v-row>
                            <div class="flex p-4 items-center">
                                <span
                                    class="bg-danger text-white w-10 h-10 flex justify-center items-center rounded-full"
                                    style="font-size:20px;">၂</span>
                                <p class="text-danger ms-3 fs-5">လုပ်ငန်းတည်နေရာ</p>
                            </div>
                        </v-row>

                        <v-row>
                            <v-col cols="6">
                                <select v-model="form.state_id" @change="getCity($event)" id=""
                                    class="form-control py-3">
                                    <option value="null">Choose a State</option>
                                    <option v-for="state in states" :key="state" :value="state.id">{{ state.name }}
                                    </option>
                                </select>
                            </v-col>

                            <v-col cols="6">
                                <v-select v-model="form.city_id" :items="cities.data" item-title="name" item-value="id"
                                    label="City"></v-select>
                            </v-col>
                        </v-row>

                        <v-row class="mx-1 my-5">
                            <v-textarea label="Location" row-height="15" rows="1" variant="outlined"></v-textarea>
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

                        <v-row class="my-3">
                            <v-col v-for="(box, index) in serviceItemBoxes" :key="index" cols="6">
                                <div
                                    class="border-2 border-danger flxex justify-center items-center position-relative p-5">
                                    <v-row class="flex">
                                        <v-col cols="4" class="flex justify-center items-center">
                                            <p>အမျိုးအစား</p>
                                        </v-col>

                                        <v-col>
                                            <select v-model="tempForm.selectedServiceId" @click="getServiceItem($event.target.value)"
                                                id="" class="form-control w-full py-3">
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

                                            <v-select :items="service_items"
                                            label="ကုန်ပစ္စည်းများနှင့် ဝန်ဆောင်မှုများ‌ရွေးချယ်မည်" item-title="name" item-value="id"
                                            multiple persistent-hint></v-select>
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

                        <div>
                            <v-row class="flex justify-center items-center">
                                <v-col cols="6" class="border-2 border-danger">
                                    <v-row class="">
                                        <v-col cols="4">
                                            <div class="flex justify-center items-center" style="height:100%;">
                                                <h3>အမျိုးအစား</h3>
                                            </div>

                                        </v-col>

                                        <v-col cols="4">
                                            <div class="flex justify-center items-center" style="height:100%;">
                                                <h3>ကုန်ပစ္စည်းနှင့် ဝန်ဆောင်မှုများ</h3>
                                            </div>

                                        </v-col>

                                        <v-col cols="4">
                                            <div class="flex justify-center items-center" style="height:100%;">
                                                <h3>စျေးနှုန်းများ</h3>
                                            </div>

                                        </v-col>
                                    </v-row>

                                    <v-row class="item">
                                        <v-col cols="4">
                                            <div class="flex justify-center items-center" style="height:100%;">
                                             
                                                <h3>{{ selectedService(tempForm.selectedServiceId) }}</h3>
                                            </div>

                                        </v-col>

                                        <v-col cols="4">
                                            <div class="flex justify-center items-center" style="height:100%;">
                                           
                                                <h3>{{ selectedServiceItems(service_items) }}</h3>
                                            </div>

                                        </v-col>

                                        <v-col cols="4" class="borde-2 border-danger mt-3">
                                            <div class="flex justify-center items-center">

                                                <v-textarea row-height="15" rows="1" variant="outlined"
                                                    auto-grow></v-textarea>
                                            </div>

                                        </v-col>
                                    </v-row>


                                </v-col>
                            </v-row>
                        </div>
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
                            <v-col cols="12">
                                <div class="square-image mx-16" style="width:120px;height:120px;border:2px solid red;">
                                </div>

                            </v-col>
                        </v-row>
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
import DeleteButton from '../Components/DeleteButton.vue';
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

const service = ref();

const loading = ref(false)
const baseUrl = inject('baseUrl');
const days = ref(['S', 'M', 'T', 'W', 'T', 'F', 'S'])
const selectedDays = ref([])
const categories = ref([])
const states = ref([])
const cities = ref([])
const services = ref([])
const tempForm = useForm({
    selectedServiceId : null
})
const service_items = ref([])
const serviceItemBoxes = ref([])
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

    const headers = {
        Authorization: `Bearer ${token}`
    };

    loading.value = true;
    const apiRequests = [
        axios.get(`${baseUrl}/shops/categories`, { headers }),
        axios.get(`${baseUrl}/getStates`, { headers }),
        axios.get(`${baseUrl}/shops/services`, { headers })
    ];
    Promise.all(apiRequests)
        .then((response) => {
            console.log(response);
            categories.value = response[0].data.data;
            states.value = response[1].data.data;
            services.value = response[2].data.data;
            loading.value = false;

        }).catch((error) => {
            console.log(error);
            loading.value = false;

        })
})

const selectedService = (serviceId) => {
    const service = services.value.find(service => service.id === serviceId);
    return service ? service.name : null;
}


const selectedServiceItems = (serviceItemIds) => {
    const serviceItem = service_items.value.find(serviceItem => serviceItem.id === Number(serviceItemIds));
    return serviceItem ? serviceItem.name : null;
}

const getCity = async (event) => {
    form.city_id = null;
    cities.value = await axios.get(`${baseUrl}/getCity?state_id=` + event.target.value);
};

const getServiceItem = async (serviceId) => {

    let data = await axios.get(
        `${baseUrl}/shops/service_items/only_service_items?service_id=` + serviceId
    );

    service_items.value = data.data;
    console.log(service_items.value);

}

const addServiceBox = () => {
    serviceItemBoxes.value.push({ services: null })
}

const removeServiceItemBox = (index) => {
    serviceItemBoxes.value.splice(index, 1);
};



</script>

<style lang="scss" scoped></style>
