<template>
    <div>
        <Layout>
            <div class="p-3">
                <v-row class="flex justify-center">
                    <v-col cols="6" class="">
                        <div>
                            <BackButton class="mt-15 mb-3" />
                            <h3 class="fs-4 font-semibold text-danger">Roles</h3>
                        </div>

                        <v-row class="flex justify-end">
                            <v-col cols="3">
                                <div class="flex">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                        class="form-control"
                                        style="border:1px solid red;color:red;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                        <div class="flex justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path
                                                    d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                                            </svg>
                                            <p style="font-size:13px;">အသစ်ထပ်ထည့်မည်</p>
                                        </div>
                                    </button>

                                    <div class="modal fade" id="addRoleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Role</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="row modal-body">
                                                    <div class="col-md-6">
                                                        <h3>Business Account</h3>
                                                    </div>

                                                    <div class="col-md-6 flex justify-between">
                                                        <div class="relative">
                                                            <input v-model="user_code" type="text"
                                                                class="form-control me-2" placeholder="Enter User Code">

                                                            <button v-if="user_code" @click="clearName()"
                                                                class="absolute top-0 -right-2 text-black px-2 py-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>

                                                            </button>
                                                        </div>



                                                        <button @click="getBusinessOwnerAcc"
                                                            class="btn btn-success btn-sm">Add</button>
                                                    </div>

                                                    <div class="col-md-6 mt-4">
                                                        <h3>Role</h3>
                                                    </div>

                                                    <div class="col-md-6 mt-4">
                                                        <select @change="handleRoleChange($event)" name="" id="" class="form-control">
                                                            <option value="" class="text-center">Select Role</option>
                                                            <option value="Admin" class="text-center">Admin</option>
                                                            <option value="Co-Admin" class="text-center">Co-Admin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button @click="assignRole" type="button" data-bs-dismiss="modal"
                                                        class="form-control text-white"
                                                        :style="{ backgroundColor: $themeColor }">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </v-col>

                            <v-col cols="3">
                                <div class="flex">
                                    <button type="button" class="form-control" data-bs-toggle="modal"
                                        data-bs-target="#leaveBusiness"
                                        style="background-color:red;color:white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                        <div class="flex justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <p style="font-size:13px;">လုပ်ငန်းမှထွက်မည်</p>
                                        </div>
                                    </button>

                                    <div class="modal fade" id="leaveBusiness" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Leave From This
                                                        Business?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to leave from this Business?
                                                </div>
                                                <div class="modal-footer border-0 flex justify-between">
                                                    <button type="button" class="form-control" data-bs-dismiss="modal"
                                                        :style="{ border: `1px solid ${themeColor}` }">Cancel</button>
                                                    <button @click="leaveBusiness" type="button"
                                                        class="form-control text-white"
                                                        :style="{ backgroundColor: $themeColor }">Confirm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12">
                                <div class="">
                                    <v-table class="table table-bordered">
                                        <thead>
                                            <tr style="color:red;font-weight: bold;font-size:17px;">
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr v-for="businessOwner in businessOwners">
                                                <td>{{ businessOwner.business_owner_id }}</td>
                                                <td>{{ checkMe(businessOwner.business_owner_id, businessOwner.name) }}
                                                </td>
                                                <td>{{ businessOwner.role }}</td>
                                                <td>
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-6">
                                                            <path
                                                                d="M10.375 2.25a4.125 4.125 0 1 0 0 8.25 4.125 4.125 0 0 0 0-8.25ZM10.375 12a7.125 7.125 0 0 0-7.124 7.247.75.75 0 0 0 .363.63 13.067 13.067 0 0 0 6.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 0 0 .364-.63l.001-.12v-.002A7.125 7.125 0 0 0 10.375 12ZM16 9.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6Z" />
                                                        </svg>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </v-table>
                                </div>
                            </v-col>
                        </v-row>

                    </v-col>
                </v-row>

            </div>
        </Layout>
    </div>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import BackButton from '../Components/BackButton.vue';
import { ref, inject, onMounted } from 'vue'
const loading = ref(false)
const baseUrl = inject('baseUrl');
const authUser = inject('authUser');
const businessOwners = ref([]);

const props = defineProps({
    shop_id: Number
})
onMounted(() => {
    let token = localStorage.getItem('token')

    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.get(`${baseUrl}/shops/business_ownerships?shop_id=${props.shop_id}`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            businessOwners.value = response.data.data;
            console.log(businessOwners.value);
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.log(error);
        })
})

const checkMe = (ids, name) => {
    const authUser = JSON.parse(localStorage.getItem('authUser'));


    const idList = Array.isArray(ids) ? ids : [ids]; // [3], [4]

    for (const id of idList) {
        if (authUser.id == id) {

            return name + ' (Me) ';
        } else {
            return name;
        }
    }
}
const user_code = ref();
const user_data = ref(
    {
        shop_id : props.shop_id,
        business_owner_id : null,
        role : ''
    }
)
const getBusinessOwnerAcc = () => {
    let token = localStorage.getItem('token')

    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.get(`${baseUrl}/shops/business_ownerships/getBusinessOwnerByUserCode?user_code=${user_code.value}&shop_id=${props.shop_id}`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response.data.data);
            businessOwners.value.forEach(businessOwner => {
                if(businessOwner.business_owner_id == response.data.data.id){
                    alert('no');
                }
            })
            user_code.value = response.data.data.name;
            user_data.value.business_owner_id = response.data.data.id;
            loading.value = false;


        })
        .catch((error) => {
            loading.value = false;
            console.log(error);
        })
}

const clearName = () => {
    user_code.value = null;
}

const handleRoleChange = (event) => {
    user_data.value.role = event.target.value;
    console.log(user_data.value);
}

const assignRole = () => {
    let token = localStorage.getItem('token')

    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.post(`${baseUrl}/shops/business_ownerships`, user_data.value, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            businessOwners.value = response.data.data;
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
        })
}
</script>

<style scoped></style>
