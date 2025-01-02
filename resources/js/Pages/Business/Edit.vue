<template>
    <Layout>
        <div class="container flex justify-center items-center" style="position:absolute;top:20px;height:120vh"
            v-if="loading">
            <Carloader style="margin-bottom: 100px;" />
        </div>

        <div class="mt-5">
            <v-row class="flex justify-center items-center h-full">
                <v-col cols="8" class="border-2 border-danger my-10">

                    <BackButton />
                    <v-row class="">
                        <v-col cols="6" class="">
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

                                <label for="fileUpload" class="absolute inset-0" v-if="form.logo">
                                    <img :src="form.logo" alt="Uploaded Image" class="object-cover w-full h-full" />
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
                                        <span class="w-36">လုပ်ငန်းနာမည်</span>
                                        <v-textarea label="" v-model="form.name" row-height="15" rows="1"
                                            variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="w-36">ဖုန်းနံပါတ်</span>
                                        <v-textarea label="" v-model="form.phone" row-height="15" rows="1"
                                            variant="outlined"></v-textarea>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <div class="flex justify-center">
                                        <span class="w-36">နေရပ်လိပ်စာ</span>
                                        <v-textarea label="" v-model="form.address" row-height="15" rows="1"
                                            variant="outlined"></v-textarea>
                                    </div>
                                </v-col>


                            </v-row>

                            <v-row class="shop-opening-time">
                                <v-col cols="12">
                                    <div>
                                        <h3>ဆိုင်ဖွင့်ချိန်</h3>
                                        <v-row>


                                            <v-col cols="12" sm="5">
                                                <v-text-field v-model="time" :active="menu2" :focus="menu2"
                                                    label="Picker in menu" prepend-icon="mdi-clock-time-four-outline"
                                                    readonly>
                                                    <v-menu v-model="menu2" :close-on-content-click="false"
                                                        activator="parent" transition="scale-transition">
                                                        <v-time-picker v-if="menu2" v-model="time"
                                                            full-width></v-time-picker>
                                                    </v-menu>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="5">
                                                <v-text-field v-model="time" :active="modal2" :focused="modal2"
                                                    label="Picker in dialog" prepend-icon="mdi-clock-time-four-outline"
                                                    readonly>
                                                    <v-dialog v-model="modal2" activator="parent" width="auto">
                                                        <v-time-picker v-if="modal2" v-model="time"></v-time-picker>
                                                    </v-dialog>
                                                </v-text-field>
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

                        <v-row class="mx-16 my-5">
                            <v-textarea label="Location" v-model="location" row-height="15" rows="1"
                                variant="outlined"></v-textarea>
                        </v-row>
                    </div>

                    {{ serviceBoxes }}
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

                                            <v-select v-model="box.items" :items="service_items[index]"
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
                                <!-- <h3>{{ selectedService(tempForm.selectedServiceId) }}</h3> -->
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

                                {{ previewImages }}
                                <label v-for="(image, index) in previewImages" :key="index">

                                    <!-- Render image preview -->

                                    <div class="relative">
                                        <img :src="image.preview" class="object-cover w-full h-full me-3"
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
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, inject, watch } from 'vue';

const props = defineProps({
    shop_id: Number
})

const business = ref()

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
const menu2 = ref(false);
const modal2 = ref(false);
const time = ref(null)


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

                form.shop_images.forEach(image => {
                    previewImages.value.push({ preview: image });
                })

                location.value = formatLocation();

            }

            business.value?.opening_days.forEach(day => {
                selectedDays.value.push(parseInt(day));
            })


            business.value?.services.forEach((service, index) => {
                let items = [];
                service.items.forEach((item, itemIndex) => {
                    items.push({
                        service_item_id: item.id,
                        price: null
                    })
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
    notes: [],
});


const selectedService = (serviceId) => {
    const service = services.value.find(service => service.id === serviceId);
    return service ? service.name : null;
}


// const selectedServiceItems = (serviceItemIds) => {
//     if (!serviceItemIds || typeof serviceItemIds[Symbol.iterator] !== 'function') {
//         console.error("Invalid serviceItemIds:", serviceItemIds); // Log error for debugging
//         return [];
//     }

//     return Array.from(serviceItemIds).map(id => {
//         const serviceItem = service_items.value.find(serviceItem => serviceItem.id === Number(id));
//         return serviceItem ? serviceItem.name : null;
//     });
// };


const getCity = async (event) => {
    form.city_id = null;
    cities.value = await axios.get(`${baseUrl}/getCity?state_id=` + event.target.value);
};

const getServiceItem = async (serviceId, index) => {

    if (serviceId) {
        let data = await axios.get(
            `${baseUrl}/shops/service_items/only_service_items?service_id=` + serviceId
        );

        service_items.value[index] = data.data;
    }


}

const addServiceBox = () => {
    serviceBoxes.value.push({
        service_id: null,
        items: [],
    })
    item_prices.value.push({})
}

const removeServiceItemBox = (index) => {
    serviceBoxes.value.splice(index, 1);
};


const handleLogoFileChange = () => {
    const file = event.target.files[0];

    if (file) {
        form.logo = URL.createObjectURL(file);
    }
}

const handleImageFileChange = (event) => {
    const fileImage = event.target.files[0];
    if (fileImage) {
        const previewUrl = URL.createObjectURL(fileImage);
        previewImages.value.push({preview:previewUrl});
    }

}

const clearImagePreview = (from, index = null) => {
    if (from == 'logo') {
        form.logo = null;
    } else {
        previewImages.value[index] = null;
        previewImages.value.splice(index, 1);
    }
}

const submit = () => {

    form.opening_days = selectedDays.value;
    setLocation()

    serviceBoxes.value.forEach((service, index) => {

        let items = [];

        service.items.forEach((item, itemIndex) => {
            items.push({
                service_item_id: item.id,
                price: item_prices.value[index][itemIndex] ?? null
            })
        })

        form.services.push({
            service_id: service.service_id,
            items: items
        });

    })

    let token = localStorage.getItem('token');

    axios.post(`${baseUrl}/shops`, form, {
        headers: {
            Authorization: `Bearer ${token}`,
        }
    }).then(response => {
        console.log(response)
    })
}


</script>

<style lang="scss" scoped></style>
