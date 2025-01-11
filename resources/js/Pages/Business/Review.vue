<template>
    <div>
        <Layout>
            <div class="mt-15">
                <h3 class="text-danger mb-5 mx-8">အကြံပြုစာများ</h3>
                <v-row class="p-4">

                    <v-col v-for="(feedback, index) in feedbacks" :key="feedback.id" class="" cols="6">

                        <!-- Feedback Information -->
                        <div class="flex border p-3 rounded-md">
                            <div class="flex">
                                <div class="me-3">
                                    <img v-if="feedback.user.photo" :src="feedback.user.photo" alt="User Photo"
                                        style="width:50px;height:50px;object-fit:cover;border-radius: 50%;">

                                    <img v-else src="../images/default_user_photo.jpg" alt=""
                                        style="width:50px;height:50px;object-fit:cover;border-radius:50%;border:1px solid red;">
                                </div>
                                <div>
                                    <h3>{{ feedback.user.name }}</h3>
                                    <Stars :ratings="feedback.star" />
                                    <p>{{ feedback.feedback }}</p>
                                    <span style="opacity: 0.7;">{{ formatDate(feedback.created_at) }}</span>
                                </div>
                            </div>
                            <div>
                                <DeleteButton />
                            </div>
                        </div>

                        <!-- Toggle Replies Button -->
                        <div class="flex justify-end mt-2">
                            <button @click="toggleReplyBox(index)" class="btn">
                                {{ replyBox[index] ? 'Close' : 'Reply' }}
                            </button>
                        </div>

                        <!-- Replies Section -->
                        <div v-if="replyBox[index]" class="mt-4">
                            <!-- List of Replies -->
                            <Reply @update="updateReply" @delete="deleteReply(feedback.id, reply.id, replyIndex)" :id="reply.id"
                                v-for="reply in feedback.replies" :index="index" :text="reply.name" :key="reply.id" :shopName="shopName" :replyIndex="replyIndex" />
                            <div v-for="(reply, replyIndex) in feedback.replies" :key="reply.id"
                                class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="../images/profile.png" alt="Profile"
                                        class="w-16 h-16 rounded-full border-2 border-success">
                                </div>

                                <!-- Reply Content -->
                                <div class="flex flex-col justify-center w-full">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ shopName }}</h3>
                                    <p v-if="!editPage[replyIndex]">{{ reply.text }}</p>
                                    <textarea v-else v-model="reply.text"
                                        class="form-control mt-2 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-success focus:outline-none w-full"
                                        placeholder="Write your reply here..."></textarea>
                                    <div v-if="!editPage[replyIndex]" class="flex justify-end my-2">
                                        <button v-bind="activatorProps" @click="editPage[replyIndex] = true"
                                            class="btn border-1 border-danger me-2">Edit</button>


                                        <v-dialog max-width="500">
                                            <template v-slot:activator="{ props: activatorProps }">
                                                <button v-bind="activatorProps" class="btn text-white"
                                                    :style="{ backgroundColor: $themeColor }">Delete</button>
                                            </template>


                                            <template v-slot:default="{ isActive }">
                                                <v-card title="Are you sure you want to delete this Reply?">

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <Button @click="deleteReply(feedback.id, reply.id, replyIndex)"
                                                            classes="mr-4 bg-red-300 text-red-800" text="Delete"
                                                            :status="1" />
                                                        <Button @click="isActive.value = false"
                                                            classes="border text-black" text="Cancel" :status="1" />
                                                    </v-card-actions>
                                                </v-card>
                                            </template>
                                        </v-dialog>
                                    </div>

                                    <div v-else class="flex justify-end my-2">
                                        <button @click="editPage[replyIndex] = !editPage[replyIndex]"
                                            class="btn border-1 border-danger me-2">Cancel</button>
                                        <button @click="updateReply(reply.id, reply.text)" class="btn text-white"
                                            :style="{ backgroundColor: $themeColor }">Update</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Reply Form -->
                            <div
                                class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="../images/profile.png" alt="Profile"
                                        class="w-16 h-16 rounded-full border-2 border-success">
                                </div>

                                <div class="flex flex-col justify-center w-full">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ shopName }}</h3>
                                    <textarea v-model="form.text[index]"
                                        class="form-control mt-2 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-success focus:outline-none w-full"
                                        placeholder="Write your reply here..."></textarea>

                                    <div class="flex justify-end my-2">
                                        <button @click="editPage[replyIndex] = !editPage[replyIndex]"
                                            class="btn border-1 border-danger me-2">Cancel</button>
                                        <button @click="reply(feedback.id, index)" class="btn text-white"
                                            :style="{ backgroundColor: $themeColor }">Send</button>
                                    </div>
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
import Button from "../Components/Button.vue";
import DeleteButton from '../Components/DeleteButton.vue'
import { ref, onMounted, inject } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';

const props = defineProps({
    shop_id: Number,
});

const router = useRouter();
const loading = ref(false);
const baseUrl = inject('baseUrl')
const feedbacks = ref([])
const toast = useToast();
const replyBox = ref([])
const editPage = ref({})
const form = useForm({
    text: []
})

const shopName = ref()

onMounted(() => {
    let token = localStorage.getItem('token');
    if (!token) {
        router.push('/login');
        return;
    }

    loading.value = true;

    axios.get(`${baseUrl}/shops/show?shop_id=${props.shop_id}`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response);
            shopName.value = response.data.data.name;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        });

    axios.get(`${baseUrl}/shops/ratings?shop_id=${props.shop_id}`, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            feedbacks.value = response.data.data;
            feedbacks.value.forEach(() => {
                replyBox.value.push(false);
                form.text.push('');
            });
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        });
});

const toggleReplyBox = (index) => {
    replyBox.value[index] = !replyBox.value[index];
}

const cancelReply = (index) => {
    form.text[index] = '';
}

const reply = (feedbackId, index) => {
    let token = localStorage.getItem('token');
    if (!token) {
        router.push("/login");
        return;
    }

    if (!form.text[index].trim()) {
        toast.warning("Reply cannot be empty.");
        return;
    }

    loading.value = true;
    axios.post(`${baseUrl}/shops/ratings/reply`, {
        rating_id: feedbackId,
        text: form.text[index]
    }, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            // Find the feedback and add the new reply
            const feedback = feedbacks.value.find(fb => fb.id === feedbackId);
            if (feedback) {
                feedback.replies.push(response.data.data);
            }
            form.text[index] = '';
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        })
}

const updateReply = (replyId, text) => {
    let token = localStorage.getItem('token');
    if (!token) {
        router.push("/login");
        return;
    }

    loading.value = true;
    axios.post(`${baseUrl}/shops/ratings/updateReply`,
        {
            reply_id: replyId,
            text: text
        }, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            console.log(response.data.data);
            editPage.value = !editPage.value;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        })
}

// Delete a reply from a specific feedback
const deleteReply = (feedbackId, replyId, replyIndex) => {

    let token = localStorage.getItem('token');
    if (!token) {
        router.push("/login");
        return;
    }

    loading.value = true;
    axios.delete(`${baseUrl}/shops/ratings/deleteReply`, {
        data: { reply_id: replyId },
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            const feedback = feedbacks.value.find(fb => fb.id === feedbackId);
            if (feedback && feedback.replies.length > replyIndex) {
                feedback.replies.splice(replyIndex, 1);
            }
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        })
}


// Format the date as per your requirement
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const formattedDate = `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
    return formattedDate;
}
</script>

<style scoped>
/* Add your styles here */
.btn {
    padding: 0.5rem 1rem;
    border: none;
    cursor: pointer;
    border-radius: 0.25rem;
}

.btn:hover {
    opacity: 0.8;
}
</style>
