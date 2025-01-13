<template>
    <div class="">
        <Header/>
        <div class="container">
            <slot/>
        </div>
        <Navbar @permission="showData" v-if="currentUrl != '/dashboard'"/>
    </div>
</template>

<script setup>
import Navbar from './Navbar.vue';
import Header from './Header.vue';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();

const currentUrl = ref(page.url);
const emit = defineEmits(['permission']);

const showData = (data) => {
    emit('permission', data)
}

</script>

<style></style>
