<template>
    <!-- List of Replies -->
    <div
        class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">
        <div class="flex-shrink-0">
            <img src="../images/profile.png" alt="Profile" class="w-16 h-16 rounded-full border-2 border-success">
        </div>

        <!-- Reply Content -->
        <div class="flex flex-col justify-center w-full">
            <h3 class="text-lg font-semibold text-gray-800">{{ shopName }}</h3>
            <p v-if="!editPage">{{ text }}</p>
            <textarea v-else v-model="props.text"
                class="form-control mt-2 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-success focus:outline-none w-full"
                placeholder="Write your reply here..."></textarea>
            <div v-if="!editPage" class="flex justify-end my-2">
                <button v-bind="activatorProps" @click="editPage = !editPage"
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
                                    classes="mr-4 bg-red-300 text-red-800" text="Delete" :status="1" />
                                <Button @click="isActive.value = false" classes="border text-black" text="Cancel"
                                    :status="1" />
                            </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>
            </div>

            <div v-else class="flex justify-end my-2">
                <button @click="isActive.value = false" class="btn border-1 border-danger me-2">Cancel</button>
                <button @click="$emit('Update',id,form.text[index]),editPage = !editPage" class="btn text-white"
                    :style="{ backgroundColor: $themeColor }">Update</button>
            </div>
        </div>
    </div>

    <!-- Reply Form -->
    <div class="mx-20 mt-4 flex items-center border-2 border-danger p-4 rounded-lg shadow-lg bg-white space-x-4">
        <div class="flex-shrink-0">
            <img src="../images/profile.png" alt="Profile" class="w-16 h-16 rounded-full border-2 border-success">
        </div>

        <div class="flex flex-col justify-center w-full">
            <h3 class="text-lg font-semibold text-gray-800">{{ shopName }}</h3>
            <textarea v-model="text[index]"
                class="form-control mt-2 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-success focus:outline-none w-full"
                placeholder="Write your reply here..."></textarea>

            <div class="flex justify-end my-2">
                <button @click="cancelReply(index)" class="btn border-1 border-danger me-2">Cancel</button>
                <button @click="reply(feedback.id, index)" class="btn text-white"
                    :style="{ backgroundColor: $themeColor }">Send</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue'
const shopName = ref()
const props = defineProps({
    id : Number,
    text: String,
    index : Number,
    replyIndex : Number
});

const form = useForm({
    text : []
})

const editPage = ref(false);
</script>

<style lang="scss" scoped></style>
