<template>
    <div>
        <Layout>
            <div class="mt-15">
                <h3 class="text-danger mb-5">အကြံပြုစာများ</h3>
                <v-row class="p-4">

                    <v-col v-for="(feedback,index) in feedbacks" :key="feedback" class="border border-danger" cols="6">

                        <div class="flex">
                            <div class="me-3">
                                <img :src="feedback.user.photo" alt=""
                                    style="width:50px;height:50px;object-fit:cover;border-radius: 50%;">
                            </div>
                            <div>
                                <h3>{{ feedback.user.name }}</h3>
                                <Stars :ratings="feedback.star" />
                                <p>{{ feedback.feedback }}</p>
                                <span style="opacity: 0.7;">{{ formatDate(feedback.created_at) }}</span>

                            </div>

                        </div>
                        <div class="flex justify-end">
                            <button v-if="replyBox" @click="getReplyBox(index)" class="btn">Reply</button>
                        </div>

                        <div v-if="replyBox">
                            <div v-for="reply in feedback.replies"
                                class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">

                                <div class="flex-shrink-0">
                                    <img src="../images/profile.png" alt="Profile"
                                        class="w-16 h-16 rounded-full border-2 border-success">
                                </div>



                                <!-- Reply Box -->
                                <div class="flex flex-col justify-center w-full">
                                    <h3 class="text-lg font-semibold text-gray-800">Test MTK</h3>
                                    <p>{{ reply.text }}</p>

                                    <div class="flex justify-end my-2">
                                        <button class="btn border-1 border-danger me-2">Edit</button>
                                        <button @click="delete" class="btn text-white"
                                            :style="{ backgroundColor: $themeColor }">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reply Box -->
                        <div v-if="replyBox[index]"
                            class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">

                            <div class="flex-shrink-0">
                                <img src="../images/profile.png" alt="Profile"
                                    class="w-16 h-16 rounded-full border-2 border-success">
                            </div>

                            <!-- Reply Box -->
                            <div class="flex flex-col justify-center w-full">
                                <h3 class="text-lg font-semibold text-gray-800">Test MTK</h3>
                                <textarea v-model="form.text"
                                    class="form-control mt-2 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-success focus:outline-none w-full"
                                    placeholder="Write your reply here..."></textarea>

                                <div class="flex justify-end my-2">
                                    <button class="btn border-1 border-danger me-2">Cancel</button>
                                    <button @click="reply(reply.id)" class="btn text-white"
                                        :style="{ backgroundColor: $themeColor }">Send</button>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </Layout>
    </div>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import Stars from "../Components/Stars.vue";
import { ref, onMounted, inject } from "vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    shop_id: Number,
});
const loading = ref(false);
const baseUrl = inject('baseUrl')
const feedbacks = ref()

const replyBox = ref([])

const getReplyBox = (index) => {
    replyBox.value[index] = true;
}

const form = useForm({
    text : null
})

onMounted(() => {
    let token = localStorage.getItem("token");

    if (!token) {
        router.get("/login");
    }

    loading.value = true;
    axios
        .get(`${baseUrl}/shops/ratings?shop_id=${props.shop_id}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then((response) => {
            feedbacks.value = response.data.data;
            feedbacks.value.forEach(feedback => {
                replyBox.value.push(false)
            })
            loading.value = false;
        })
        .catch((error) => {
            loading.value = false;
            console.log(error);
        });
});


const reply = (id) => {

    let token = localStorage.getItem('token');
    if (!token) {
        router.get("login");
    }

    loading.value = true;
    axios.post(`${baseUrl}/shops/ratings/reply`, {
        rating_id : id,
        text: form.text
    },{
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            console.log(response.data.data);
            feedbacks.replies.push = response.data.data;
            loading.value = false;
        })

        .catch((error) => {
            console.log(error);
            loading.value = false;
        })
}


const formatDate = (dateString) => {
    // Create a new Date object from the dateString
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Format the date as per your requirement
    const formattedDate = `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;

    return formattedDate;
}
</script>

<style scoped></style>
