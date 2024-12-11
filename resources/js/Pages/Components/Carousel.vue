<template>
    <v-carousel height="200" class="rounded-lg shadow-sm" show-arrows="hover" cycle hide-delimiter-background>
        <v-carousel-item v-for="image in images" :key="image">
            <v-sheet height="100%">
                <img :src="image" class="w-100 h-100" style="object-fit:cover;object-position:center">
            </v-sheet>
        </v-carousel-item>
    </v-carousel>
</template>

<script setup>
const props = defineProps({
    images: Array
})
</script>

<style></style>
