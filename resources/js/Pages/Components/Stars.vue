<template>

    <div class="rating">
        <v-rating hover readonly :length="5" :size="32" :model-value="ratings" active-color="warning" />
    </div>

</template>

<script setup>

const props = defineProps({
    ratings: {
        type: Number,
        required: true,
    }
})
</script>

<style scoped>
.rating {
    display: inline-block;
}

.rating input {
    display: none;
}

.rating label {
    float: right;
    cursor: pointer;
    transition: color 0.3s;
}

.rating label:before {
    content: "\2605";
    font-size: 30px;
}

.rating input:checked~label,
.rating label:hover,
.rating label:hover~label {
    color: #ffd700;
    transition: color 0.3s;
}
</style>
