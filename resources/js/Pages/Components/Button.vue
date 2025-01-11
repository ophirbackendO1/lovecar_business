<template>
    <button :style="{ backgroundColor: $themeColor }" class="btn text-white" :class="classes">
        <span class="">
            {{ text }}
        </span>
            <font-awesome-icon v-if="!status" class="ms-2" icon="fa-solid fa-wrench" />
    </button>
</template>

<script setup>
const props = defineProps({
    text: String,
    status: Number,
    classes : String
})
</script>

<style></style>
