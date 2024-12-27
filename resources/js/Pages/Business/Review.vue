<template>
    <div>
        <Layout> </Layout>
    </div>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import { onMounted } from "vue";
const props = defineProps({
    shop_id: Number,
});

onMounted(() => {
    let token = localStorage.getItem("token");

    if (!token) {
        router.get("/login");
    }

    loading.value = true;
    axios
        .get(`${baseUrl}/shops/rating?shop_id=${props.shop_id}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then((response) => {
            console.log(response);
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.log(error);
        });
});
</script>

<style scoped></style>
