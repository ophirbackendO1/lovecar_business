<template>
    <div :style="{ backgroundColor: $themeColor }" class="shadow-sm" style="position:sticky;top:0px;z-index:50">
        <div class="container p-3 flex items-center justify-between text-white">
            <Link :href="route('dashboard')">
            <brand class="h5 col-6">
                <div>
                    Admin Dashboard
                </div>
            </brand>
            </Link>

            <div class="flex justify-center items-center">
                <img src="../images/profile.png" style="width:60px;" alt="">
                <div class="dropdown">
                    <a class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">{{ businessOwner?.name }} <span v-if="businessOwner?.role"> - ({{
                            businessOwner?.role?.charAt(0).toUpperCase() + businessOwner?.role?.slice(1) }}
                        )</span> </a>

                    <ul class="dropdown-menu">
                        <li @click="logout"><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, inject } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const user = JSON.parse(localStorage.getItem('user'));

const page = usePage();
const shopId = page.props.shop_id;
const baseUrl = inject('baseUrl');
const loading = ref(false);

const businessOwner = ref()

const logout = () => {
    localStorage.removeItem('token');
    router.visit('/login')
}
onMounted(() => {
    let token = localStorage.getItem('token');
    if (!token) {
        router.get('/login');
    }

    loading.value = true;

    if (user) {
        axios
            .get(`${baseUrl}/get-business-owner-role?user_id=${user.id}&&shop_id=${shopId}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
            .then(response => {
                console.log(response.data.data);
                businessOwner.value = response.data.data;
                localStorage.setItem('authUser', JSON.stringify(businessOwner.value));
            })
            .catch(error => {
                console.error('Error fetching roles:', error);
                loading.value = false;
            });
    }
});
</script>

<style></style>
