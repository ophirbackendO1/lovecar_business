<template>
    <div>
        <Layout>
            <div class="container w-50 p-5 mt-5">
                <div class="flex justify-between items-center" style="min-height:10vh;">
                    <BackButton />
                    <h3 class="font-semibold" :style="{ color: $themeColor }">ကြည့်ရှုမှု စုစုပေါင်း</h3>
                    <div class="flex" :style="{ color: $themeColor }">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd"
                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span v-if="totalViewByYear && totalViewByYear.length > 0" class="ms-2 font-semibold">
                            {{ totalViewByYear[0][1] }}
                        </span>
                        <span v-else class="ms-2">0</span>

                    </div>
                    <div class="relative">
                        <button @click="dropDown" class="btn border-1 border-danger flex"> <svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ms-2">{{ selectedYear }}</span></button>

                        <div v-if="isOpen"
                            class="absolute mt-2 w-48 bg-white border rounded shadow-md max-h-60 overflow-y-auto">
                            <ul>
                                <li v-for="year in years" :key="year" @click="selectYear(year)"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                                    {{ year }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <div v-for="([month, views], index) in totalViewByYear" :key="index"
                        class="border-1 rounded-lg p-4 flex justify-between border-black my-2">
                        <div class="flex">
                            <div class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path
                                        d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                                    <path fill-rule="evenodd"
                                        d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                {{ month }}
                            </div>
                        </div>

                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd"
                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ms-2">{{ views }}</span>

                        </div>

                    </div>
                </div>
            </div>


        </Layout>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import BackButton from '../Components/BackButton.vue';
import Layout from '../Layouts/Layout.vue';

const loading = ref(false)
const baseUrl = inject('baseUrl');
const total_view = ref();
const totalViewByYear = ref();
const isOpen = ref(false)
const selectedYear = ref()
const props = defineProps({
    shop_id: Number
})

const fetchViewData = async () => {
    const token = localStorage.getItem('token');
    if (!token) return router.push('/login');

    if (!selectedYear.value) {
        selectedYear.value = new Date().getFullYear();
    }

    loading.value = true;

    try {

        const viewByYearResponse = await axios.get(`${baseUrl}/shops/viewByYear`, {
            params: { shop_id: props.shop_id, year: selectedYear.value },
            headers: { Authorization: `Bearer ${token}` }
        });

        totalViewByYear.value = Object.entries(viewByYearResponse.data.data);
        console.log(`Total View By Year - ${totalViewByYear.value}`)

    } catch (error) {
        console.error(error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchViewData);

const dropDown = () => {
    isOpen.value = !isOpen.value;
}

const selectYear = (year) => {
    selectedYear.value = year;
    isOpen.value = false;
    fetchViewData();
}

const getYears = () => {
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 50;
    return Array.from({ length: 101 }, (_, i) => startYear + i);
}
const years = getYears()
</script>

<style lang="scss" scoped></style>
