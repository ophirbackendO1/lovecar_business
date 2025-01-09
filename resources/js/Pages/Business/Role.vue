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
                                                    <div class="col-md-5">
                                                        <h3>Business User Code</h3>
                                                    </div>

                                                    <div class="col-md-7 flex">
                                                        <div class="relative">
                                                            <input v-model="user_code" type="text"
                                                                class="py-2 px-2 rounded-md border-0 outline-none text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6"
                                                                :style="{ color: themeColor }"
                                                                placeholder="Enter User Code">

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
                                                            class="btn btn-sm text-white ms-3 w-100"
                                                            :style="{ backgroundColor: $themeColor }">Add</button>
                                                    </div>

                                                    <div class="col-md-5 mt-4">
                                                        <h3>Role</h3>
                                                    </div>

                                                    <div class="col-md-7 mt-4">
                                                        <select @change="handleRoleChange($event)" name="" id=""
                                                            class="form-control">

                                                            <option value="Admin" class="text-center">Admin</option>
                                                            <option value="Co-Admin" class="text-center">Co-Admin
                                                            </option>
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
                                    <v-dialog max-width="500">
                                        <template v-slot:activator="{ props: activatorProps }">
                                            <button v-bind="activatorProps" type="button" class="form-control"
                                                data-bs-toggle="modal" data-bs-target="#leaveBusiness"
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
                                        </template>


                                        <template v-slot:default="{ isActive }">
                                            <v-card title="Leave from this business?">
                                                <v-card-text>
                                                    Are you sure you want to leave this business?
                                                </v-card-text>

                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <Button @click="isActive.value = false" classes="border text-black"
                                                    text="Cancel" :status="1" />

                                                    <Button @click="leaveBusiness"
                                                        classes="mr-4 bg-red-300 text-red-800" text="Confirm"
                                                        :status="1" />

                                                </v-card-actions>
                                            </v-card>
                                        </template>
                                    </v-dialog>
                                </div>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12">
                                <div class="">
                                    <v-table class="table table-bordered">
                                        <thead>
                                            <tr style="color:red;font-weight: bold;font-size:17px;">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr v-for="(businessOwner, index) in businessOwners" :key="index">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ checkMe(businessOwner.business_owner_id, businessOwner.name) }}
                                                </td>
                                                <td>{{ businessOwner.role.charAt(0).toUpperCase() + businessOwner.role.slice(1) }}</td>
                                                <td class="flex">
                                                    <button v-if="authUser.id != businessOwner.business_owner_id"
                                                        type="button" class="me-3" data-bs-toggle="modal"
                                                        :data-bs-target="'#kickModal' + index">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-6">
                                                            <path
                                                                d="M10.375 2.25a4.125 4.125 0 1 0 0 8.25 4.125 4.125 0 0 0 0-8.25ZM10.375 12a7.125 7.125 0 0 0-7.124 7.247.75.75 0 0 0 .363.63 13.067 13.067 0 0 0 6.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 0 0 .364-.63l.001-.12v-.002A7.125 7.125 0 0 0 10.375 12ZM16 9.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6Z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Kick Modal -->
                                                    <div class="modal fade" :id="'kickModal' + index" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Kick from business</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you want to kick {{ businessOwner.name }} from
                                                                    this business?
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="button" class="btn"
                                                                        data-bs-dismiss="modal">Back</button>
                                                                    <button
                                                                        @click="kickBusinessOwner(index, businessOwner.id)"
                                                                        type="button" class="btn text-white"
                                                                        data-bs-dismiss="modal"
                                                                        :style="{ backgroundColor: $themeColor }">
                                                                        Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="me-3" data-bs-toggle="modal"
                                                        :data-bs-target="'#editRoleModal' + index">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-6">
                                                            <path
                                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                            <path
                                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                        </svg>

                                                    </button>

                                                    <!-- Edit Role Modal -->
                                                    <div class="modal fade" :id="'editRoleModal' + index" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Change Ownership</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div
                                                                        class="border flex items-center py-3 rounded-lg">
                                                                        <div class="me-3 ms-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" fill="currentColor"
                                                                                class="size-6">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>

                                                                        </div>

                                                                        <div>
                                                                            <h3>{{ businessOwner?.name }}</h3>
                                                                        </div>
                                                                    </div>

                                                                    <div class=" mt-4">
                                                                        <select @change="selected($event.target.value)"
                                                                            name="" id="" class="form-control" :value="businessOwner?.role">

                                                                            <option value="admin">
                                                                                Admin</option>
                                                                            <option value="co-admin">Co-Admin
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button
                                                                        @click="changeOwnership(businessOwner.id, index)"
                                                                        type="button" class="btn text-white w-full"
                                                                        data-bs-dismiss="modal"
                                                                        :style="{ backgroundColor: $themeColor }">
                                                                        Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
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
import Button from '../Components/Button.vue';
import { useToast } from 'vue-toastification';
import { ref, inject, onMounted } from 'vue'
import { router, useForm } from '@inertiajs/vue3';
const loading = ref(false)
const baseUrl = inject('baseUrl');
const businessOwners = ref([]);
const toast = useToast();
const props = defineProps({
    shop_id: Number
})

const authUser = ref(JSON.parse(localStorage.getItem('authUser')));
const selectedRole = ref();
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

            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.log(error);
        })
})

const checkMe = (ids, name) => {

    const idList = Array.isArray(ids) ? ids : [ids]; // [3], [4]

    for (const id of idList) {
        if (authUser.value.id == id) {

            return name + ' (Me) ';
        } else {
            return name;
        }
    }
}
const user_code = ref();
const user_data = ref(
    {
        shop_id: props.shop_id,
        business_owner_id: null,
        role: ''
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

            if (response.data.status != 200) {
                toast.warning(`${response.data.message}`);
            }

            user_code.value = response.data.data.name;
            user_data.value.business_owner_id = response.data.data.id;
            loading.value = false;


        })
        .catch((error) => {
            loading.value = false;
            console.log(error.response);
        })
}

const clearName = () => {
    user_code.value = null;
}

const handleRoleChange = (event) => {
    user_data.value.role = event.target.value;
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
            console.log(response);
            businessOwners.value.push(response.data.data);
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
        })
}

const kickBusinessOwner = (index, id) => {

    let token = localStorage.getItem('token')
    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.delete(`${baseUrl}/shops/business_ownerships/kickUser`, {
        data: { id: id },
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            businessOwners.value.splice(index, 1);
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.error(error);
        })
}

const selected = (role) => {
    selectedRole.value = role;
}


const changeOwnership = (id, index) => {

    let token = localStorage.getItem('token')
    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.post(`${baseUrl}/shops/business_ownerships/changeRole`,
        {
            id: id,
            role: selectedRole.value
        }, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            businessOwners.value.splice(index, 1);
            businessOwners.value.push(response.data.data);
            loading.value = false;
            toast.success('Role Changed Successfully');
        })
        .catch((error) => {
            loading.value = false;
            console.error(error);
        })
}


const leaveBusiness = () => {

    let token = localStorage.getItem('token')
    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.delete(`${baseUrl}/shops/business_ownerships/leave`, {
        data: { shop_id: props.shop_id },
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            router.replace('/dashboard')
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.error(error);
        })
}

</script>

<style scoped></style>
