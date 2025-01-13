<template>
    <div v-if="shopId" class="button-container rounded-md px-2 z-10"
        style="position:fixed;top:100px;left:50%;transform: translate(-50%);width:1000px;" :style="{backgroundColor:$themeColor}">

        <Link :href="route('dashboard')" class="no-underline hover:none">
        <button class="btn flex text-white hover:bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
            <h3 class="ms-2">Dashboard</h3>
        </button>

        </Link>

        <Link v-if="permission?.update_daily_info " :href="route('business.dailyUpdate', { shop_id: shopId })"><button class="btn flex text-white hover:bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75Z" />
                <path fill-rule="evenodd"
                    d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18Z"
                    clip-rule="evenodd" />
                <path
                    d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
            </svg>
            <h3 class="ms-2">UpdateDailyInfo</h3>
        </button>
        </Link>

        <Link v-if="authUser.role == 'admin'" :href="route('business.permission', { shop_id: shopId })"><button class="btn flex text-white hover:bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z"
                    clip-rule="evenodd" />
            </svg>
            <h3 class="ms-2">Permissions</h3>

        </button>
        </Link>

        <Link :href="route('business.role', { shop_id: shopId })">
        <button class="btn flex text-white hover:bg-indigo-500 me-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 0 1-.517.608 7.45 7.45 0 0 0-.478.198.798.798 0 0 1-.796-.064l-.453-.324a1.875 1.875 0 0 0-2.416.2l-.243.243a1.875 1.875 0 0 0-.2 2.416l.324.453a.798.798 0 0 1 .064.796 7.448 7.448 0 0 0-.198.478.798.798 0 0 1-.608.517l-.55.092a1.875 1.875 0 0 0-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 0 1-.064.796l-.324.453a1.875 1.875 0 0 0 .2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 0 1 .796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 0 1 .517-.608 7.52 7.52 0 0 0 .478-.198.798.798 0 0 1 .796.064l.453.324a1.875 1.875 0 0 0 2.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 0 1-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 0 0 1.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 0 1-.608-.517 7.507 7.507 0 0 0-.198-.478.798.798 0 0 1 .064-.796l.324-.453a1.875 1.875 0 0 0-.2-2.416l-.243-.243a1.875 1.875 0 0 0-2.416-.2l-.453.324a.798.798 0 0 1-.796.064 7.462 7.462 0 0 0-.478-.198.798.798 0 0 1-.517-.608l-.091-.55a1.875 1.875 0 0 0-1.85-1.566h-.344ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                    clip-rule="evenodd" />
            </svg>
            <h3 class="ms-2">Roles</h3>
        </button>
        </Link>



        <Link v-if="permission?.edit_info" :href="route('business.edit', { shop_id: shopId })">
        <button class="btn flex text-white hover:bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path
                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                <path
                    d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
            </svg>

            <h3 class="ms-2">Edit Shop Info</h3>

        </button>
        </Link>

        <v-dialog v-if="authUser?.role == 'admin'" max-width="500">
            <template v-slot:activator="{ props: activatorProps }">
                <button v-bind="activatorProps" class="btn flex text-white hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h3 class="ms-2">Delete Shop</h3>

                </button>
            </template>


            <template v-slot:default="{ isActive }">
                <v-card title="Confirm to delete">
                    <v-card-text>
                        Are you sure you want to delete?
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <Button @click="deleteShop(shopId)" classes="mr-4 bg-red-300 text-red-800" text="Delete"
                            :status="1" />
                        <Button @click="isActive.value = false" classes="border text-black" text="Cancel" :status="1" />
                    </v-card-actions>
                </v-card>
            </template>
        </v-dialog>

    </div>

</template>

<script setup>
import {ref,inject,onMounted,provide} from 'vue';
import { route } from 'ziggy-js';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import Button from '../Components/Button.vue';
const page = usePage();
const shopId = page.props.shop_id;
const baseUrl = inject('baseUrl')
const loading = ref(false)
const toast = useToast();
const permission = ref()
const authUser = ref(JSON.parse(localStorage.getItem('authUser')));
const emit = defineEmits(['permission']);

onMounted(() => {
    let token = localStorage.getItem("token");

    if (!token) {
        router.get("/login");
    }

    loading.value = true;
    axios
        .get(
            `${baseUrl}/shops/business_ownerships/getPermission?shop_id=${shopId}`,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        )
        .then((response) => {
            permission.value = response.data.data;
            emit('permission', permission.value);
            loading.value = false;
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
        });
});

const deleteShop = (shop_id) => {
    let token = localStorage.getItem('token');
    if (!token) {
        router.get('/login');
    }

    loading.value = true;
    axios.delete(`${baseUrl}/shops`, {
        params : {id : shop_id},
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            toast.success('Business deleted successfully');
            router.replace('/dashboard');
            loading.value = false;

        }).catch((error) => {
            console.log(error);
            loading.value = false;

        })

}
</script>

<style scoped>
.button-container {
    display: flex;
    align-items: center;
    height: 50px;
    justify-content: space-around;
}

.button {
    outline: 0 !important;
    border: 0 !important;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: all ease-in-out 0.3s;
    cursor: pointer;
}
</style>
