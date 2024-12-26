<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>
        <div class="mt-5">
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

                            <div class="w-60 h-60 flex items-center justify-center relative mx-14 rounded-md"
                                style="border:1px solid black;background-color:lightgray;">
                                <input type="file" id="fileUpload" class="absolute inset-0 opacity-0 cursor-pointer"
                                    @change="handleLogoFileChange" />

                                <label for="fileUpload"
                                    class="cursor-pointer text-center text-red-500 hover:text-red-700 flex flex-col items-center justify-center space-y-2"
                                    v-if="!logoPreview">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <span>Upload Logo</span>
                                </label>

                                <label for="fileUpload" class="absolute inset-0" v-if="logoPreview">
                                    <img :src="logoPreview" alt="Uploaded Image" class="object-cover w-full h-full" />
                                    <button @click="clearImagePreview('logo')"
                                        class="absolute top-0 right-0 text-white px-2 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    </button></label>
                            </div>


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

                        <v-row class="mx-14 my-5">
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

                        <v-row class="my-3 mx-14">
                            <v-col v-for="(box, index) in serviceItemBoxes" :key="index" cols="6">
                                <div
                                    class="border-2 border-danger flxex justify-center items-center position-relative p-5">
                                    <v-row class="flex">
                                        <v-col cols="4" class="flex justify-center items-center">
                                            <p>အမျိုးအစား</p>
                                        </v-col>

                                        <v-col>
                                            <select v-model="tempForm.selectedServiceId"
                                                @click="getServiceItem($event.target.value)" id=""
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

                                            <v-select v-model="tempForm.selectedServiceItemId" :items="service_items"
                                                label="ကုန်ပစ္စည်းများနှင့် ဝန်ဆောင်မှုများ‌ရွေးချယ်မည်"
                                                item-title="name" item-value="id" multiple persistent-hint></v-select>
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

                        <v-row class="mx-14">
                            <v-col v-if=selectedService(tempForm.selectedServiceId) cols="6 border">
                                <h3>{{ selectedService(tempForm.selectedServiceId) }}</h3>
                                <div v-for="(item, index) in selectedServiceItems(tempForm.selectedServiceItemId)"
                                    class="row flex justify-between mt-5">
                                    <div class="col-md-8">
                                        <p>{{ item }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control">
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
                        {{ images }}
                        <v-row>
                            <v-col cols="12" class="flex">
                                <div v-for="(image, index) in images" :key="index"
                                    class="square-image mx-16 flex justify-center items-center relative"
                                    style="width:150px;height:150px;border:2px solid red;border-radius: 10px;overflow:hidden;">
                                    <input type="file" :id="`fileImageUpload-${index}`"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                        @change="handleImageFileChange($event, index)" />


                                    <label :for="`fileImageUpload-${index}`"
                                        class="cursor-pointer text-center text-red-500 hover:text-red-700 flex flex-col items-center justify-center space-y-2"
                                        v-if="!image.preview">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <span>Add Image</span>

                                    </label>

                                    <label :for="`fileImageUpload-${index}`" class="absolute inset-0"
                                        v-if="image.preview">
                                        <img :src="image.preview" alt="Uploaded Image"
                                            class="object-cover w-full h-full" />

                                        <button @click="clearImagePreview('image', index)"
                                            class="absolute top-0 right-0 text-black px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                        </button>
                                    </label>
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

const loading = ref(false)
const baseUrl = inject('baseUrl');
const days = ref(['S', 'M', 'T', 'W', 'T', 'F', 'S'])
const selectedDays = ref([])
const categories = ref([])
const states = ref([])
const cities = ref([])
const services = ref([])
const tempForm = useForm({
    selectedServiceId: null,
    selectedServiceItemId: null
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
    if (!serviceItemIds || typeof serviceItemIds[Symbol.iterator] !== 'function') {
        console.error("Invalid serviceItemIds:", serviceItemIds); // Log error for debugging
        return [];
    }

    return Array.from(serviceItemIds).map(id => {
        const serviceItem = service_items.value.find(serviceItem => serviceItem.id === Number(id));
        return serviceItem ? serviceItem.name : null;
    });
};


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

const logoPreview = ref(null)
const images = ref([
    { preview: null }
])


const handleLogoFileChange = () => {
    const file = event.target.files[0];

    if (file) {
        logoPreview.value = URL.createObjectURL(file);
    }
}

const handleImageFileChange = (event, index) => {
    const fileImage = event.target.files[0];
    if (fileImage) {
        images.value[index].preview = URL.createObjectURL(fileImage);
    }
}

const clearImagePreview = (from, index = null) => {
    if (from == 'logo') {
        logoPreview.value = null;
    } else {
        images.value[index].preview = null;
    }
}




</script>

<style lang="scss" scoped></style>
