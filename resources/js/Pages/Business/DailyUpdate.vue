<template>
    <div>
        <Layout>
            <v-row class="flex justify-center mt-10">
                <v-col cols="6">
                    <BackButton class="mt-3" />
                    <h3 class="text-danger mb-5 fs-5 font-bold text-center">
                        Daily Updates Info
                    </h3>
                </v-col>
            </v-row>

            <div class="flex justify-center items-center" style="height: 70vh;" v-if="loading">
                <Carloader style="margin-bottom: 100px;" />
            </div>
            <div v-else class="container p-4">
                <v-row class="mb-4 flex justify-center">
                    <v-col v-for="(service, index) in dailyUpdate?.services" :key="service.id" :cols="6"
                        class="rounded-md p-4">
                        <h3 class="mb-10 fs-5">{{ service.name }}</h3>

                        <div class="service-items">
                            <div v-for="(item, innerIndex) in service.items" :key="innerIndex"
                                class="row flex justify-between p-2 rounded-lg border my-3" data-bs-toggle="modal"
                                :data-bs-target="'#dailyUpdateModal' + index"
                                style="background-color: pink; opacity: 0.9;"
                                @click="setSelectedItem(item, innerIndex)">
                                <div class="col-md-6 text-center">
                                    <h3 class="">{{ item.name }}</h3>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p v-if="item.price > 0">{{ item.price }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="container">
                                        <input class="input" type="checkbox" :checked="item.is_active" disabled />
                                        <div class="checkmark mx-auto"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div v-if="isModal" class="modal fade" :id="'dailyUpdateModal' + index" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            {{ service.name }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <v-row>
                                            <v-col cols="7">
                                                <h3>
                                                    {{ selectedItem?.name }}
                                                </h3>
                                            </v-col>
                                            <v-col cols="5">
                                                <div class="flex justify-between items-center">
                                                    <h3>Status</h3>
                                                    <div
                                                        class="border-1 border-danger rounded-lg flex justify-between px-3 py-2">
                                                        <label class="container">
                                                            <input class="input" type="checkbox"
                                                                :checked="selectedItem?.is_active" @click="
                                                                    selectedItem.is_active = !selectedItem.is_active
                                                                    " />
                                                            <div class="checkmark mx-auto"></div>
                                                        </label>

                                                        <h3 v-if="selectedItem?.is_active">
                                                            Valid
                                                        </h3>
                                                        <h3 v-else>Void</h3>
                                                    </div>
                                                </div>

                                                <div class="flex justify-between items-center">
                                                    <h3>Price</h3>
                                                    <div class="rounded-lg px-3 py-2">
                                                        <input type="number" class="form-control"
                                                            v-model="tempForm.price" />
                                                    </div>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" data-bs-dismiss="modal" class="form-control text-white"
                                            :style="{
                                                backgroundColor: $themeColor,
                                            }" @click="updateItem(service)">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>

                <v-row class="flex justify-center mb-4">
                    <v-col cols="6" class="">
                        <h3 class="mb-5 mx-5">မှတ်ချက်ရေးရန်</h3>

                        <div v-for="(note, index) in form.notes" class="" :key="index">
                            <div class="border p-3 rounded-lg my-3 flex justify-between">

                                <input type="text" class="form-control" v-model="note.text">
                                <div>
                                    <button @click="removeNote(note.id, index)" class="btn">
                                        <svg viewBox="0 0 15 17.5" height="17.5" width="15"
                                            xmlns="http://www.w3.org/2000/svg" class="icon">
                                            <path transform="translate(-2.5 -1.25)"
                                                d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z"
                                                id="Fill"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div v-if="form.notes.length == 0" @click="addNote" class="flex justify-center border-1 border-danger py-2 rounded-lg">
                            <button class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                        clip-rule="evenodd" />
                                </svg>
                                နှိပ်ပါ
                            </button>
                        </div>

                        <div v-if="form.notes.length > 0" @click="addNote" class="flex justify-center border-1 border-danger py-2 rounded-lg">
                            <button class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                        clip-rule="evenodd" />
                                </svg>
                                အသစ်ထည့်ရန်
                            </button>
                        </div>
                    </v-col>
                </v-row>

                <div class="flex justify-center">
                    <button @click="updateDaily" class="form-control w-96 text-white"
                        :style="{ backgroundColor: $themeColor }">
                        Update
                    </button>
                </div>
            </div>
        </Layout>
    </div>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import BackButton from "../Components/BackButton.vue";
import Carloader from "../Components/Carloader.vue";
import { ref, onMounted, inject } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia';
const loading = ref(false);
const dailyUpdate = ref(null);
const baseUrl = inject("baseUrl");

const addNote = () => {
    form.notes.push({
        id: null,
        text: ''
    })
};

const props = defineProps({
    shop_id: Number,
});

const form = useForm({
    shop_id: props.shop_id,
    service_items: [],
    notes: [],
    delete_note_ids: [],
});

const tempForm = useForm({
    price: null,
});

onMounted(() => {
    let token = localStorage.getItem("token");
    if (!token) {
        router.get("/login");
    }

    loading.value = true;
    axios
        .get(`${baseUrl}/shops/daily_update?shop_id=${props.shop_id}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then((response) => {
            console.log(response);
            dailyUpdate.value = response.data.data;
            form.notes = response.data.data.shop_notes;
            loading.value = false;
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
        });
});

const selectedItem = ref();
const isModal = ref(true);
const selectedIndex = ref(null);

const setSelectedItem = (item, index) => {
    selectedItem.value = item;
    selectedIndex.value = index;
    tempForm.price = item.price;
};

const updateItem = (service) => {
    service.items[selectedIndex.value].price = tempForm.price;
    service.items[selectedIndex.value].is_active = selectedItem.value.is_active;
    tempForm.price = null;

    let isInclude = false;
    form.service_items.forEach((element) => {
        if (element.id == selectedItem.value.id) {
            isInclude = true;
            element.price = selectedItem.value.price;
            element.is_active = selectedItem.value.is_active;
        }
    });

    if (!isInclude) {
        form.service_items.push({
            id: selectedItem.value.id,
            price: selectedItem.value.price,
            is_active: selectedItem.value.is_active,
        });
    }
};

const removeNote = (id, index) => {

    if (id !== null) {
        form.delete_note_ids.push(id);
    }
    form.notes.splice(index, 1)

}

const updateDaily = () => {
    let token = localStorage.getItem("token");
    axios.post(`${baseUrl}/shops/daily_update/update`, form, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })

        .then((response) => {
            console.log(response.data.data);
            Inertia.visit('/business/details', {
                method: 'get',
                data: { shop_id: props.shop_id }
            });

        })

        .catch((error) => {
            loading.value = false;
            console.log("Error updating daily info", error);
        });
}
</script>

<style scoped>
.container .input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
    border-radius: 5px;
}

.container {
    display: block;
    position: relative;
    cursor: pointer;

    user-select: none;
    border-radius: 5px;
}

/* Create a custom checkbox */
.checkmark {
    position: relative;
    top: 0;
    left: 0;
    height: 1.3em;
    width: 1.3em;
    background-color: #ccc;
    border-radius: 5px;
}

/* When the checkbox is checked, add a blue background */
.container .input:checked~.checkmark {
    opacity: 1;
    background-image: linear-gradient(45deg,
            red 0%,
            red 100%);
}

.container .input~.checkmark {
    transition: all 0.2s;
    opacity: 1;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    opacity: 0;
    transition: all 0.2s;
}

/* Show the checkmark when checked */
.container .input:checked~.checkmark:after {
    opacity: 1;
    transition: all 0.2s;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 0.45em;
    top: 0.25em;
    width: 0.25em;
    height: 0.5em;
    border: solid white;
    border-width: 0 0.15em 0.15em 0;
    transform: rotate(45deg);
}

/* From Uiverse.io by boryanakrasteva */
.btn {
    background-color: transparent;
    position: relative;
    border: none;
}

.btn::after {
    content: "delete";
    position: absolute;
    top: -130%;
    left: 50%;
    transform: translateX(-50%);
    width: fit-content;
    height: fit-content;
    background-color: rgb(168, 7, 7);
    padding: 4px 8px;
    border-radius: 5px;
    transition: 0.2s linear;
    transition-delay: 0.2s;
    color: red;
    text-transform: uppercase;
    font-size: 12px;
    opacity: 0;
    visibility: hidden;
}

.icon {
    transform: scale(1.2);
    transition: 0.2s linear;
}

.btn:hover>.icon {
    transform: scale(1.5);
}

.btn:hover>.icon path {
    fill: rgb(168, 7, 7);
}
</style>
