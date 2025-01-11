<template>
    <div>
        <Layout>
            <div class="mt-15">
                <v-row class="flex justify-center">
                    <v-col cols="6">
                        <div class="flex flex-col justify-start">
                            <BackButton class="mt-3" />
                            <h3 class="fs-5 text-danger font-semibold p-3">
                                Co-Admin Permissions
                            </h3>
                        </div>

                        <!-- Content Management -->
                        <div class="border-2 border-danger rounded-lg mb-5">
                            <h3 class="text-danger p-3 fs-5 font-semibold">
                                Content Management
                            </h3>

                            <div class="border rounded-md mt-3 mx-3">
                                <div class="flex justify-between items-center p-4">
                                    <h3>Updating Daily Info</h3>
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" :checked="permission?.update_daily_info
                                                " @change="
                                                    togglePermission(
                                                        $event,
                                                        permission.shop_id,
                                                        'update_daily_info'
                                                    )
                                                    " />
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>

                                <div v-if="permission?.update_daily_info"
                                    class="border p-2 mx-6 flex justify-between items-center mb-4 rounded-lg">
                                    <h1>Updating Items Price</h1>
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" :checked="permission?.update_item_price
                                                " @change="
                                                    togglePermission(
                                                        $event,
                                                        permission.shop_id,
                                                        'update_item_price'
                                                    )
                                                    " />
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-2 mx-5 mt-3 flex justify-between items-center mb-4 rounded-lg">
                                <h1>Editing Business Info</h1>
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" :checked="permission?.edit_info" @change="
                                            togglePermission(
                                                $event,
                                                permission.shop_id,
                                                'edit_info'
                                            )
                                            " />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- User Management -->
                        <div class="border-2 border-danger rounded-lg mb-5">
                            <h3 class="text-danger p-3 fs-5 font-semibold">
                                User Management
                            </h3>

                            <div class="border p-2 mx-5 mt-3 flex justify-between items-center mb-4 rounded-lg">
                                <h1>Allowing To Reply Reviews</h1>
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" :checked="permission?.reply_reviews" @change="
                                            togglePermission(
                                                $event,
                                                permission.shop_id,
                                                'reply_reviews'
                                            )
                                            " />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="border p-2 mx-5 mt-3 flex justify-between items-center mb-4 rounded-lg">
                                <h1>Allowing To Delete Reviews</h1>
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" :checked="permission?.delete_reviews
                                            " @change="
                                                togglePermission(
                                                    $event,
                                                    permission.shop_id,
                                                    'delete_reviews'
                                                )
                                                " />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Administrative Controls -->

                        <div class="border-2 border-danger rounded-lg mb-5">
                            <h3 class="text-danger p-3 fs-5 font-semibold">
                                Administrative Controls
                            </h3>

                            <div class="border p-2 mx-5 mt-3 flex justify-between items-center mb-4 rounded-lg">
                                <h1>Assigning Another Co-Admin</h1>
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" :checked="permission?.assign_role" @change="
                                            togglePermission(
                                                $event,
                                                permission.shop_id,
                                                'assign_role'
                                            )
                                            " />
                                        <span class="slider"></span>
                                    </label>
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
import BackButton from "../Components/BackButton.vue";
import { ref, onMounted, inject } from "vue";
import { useToast } from "vue-toastification";
const loading = ref(false);
const baseUrl = inject("baseUrl");
const permission = ref(null);
const toast = useToast();

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
        .get(
            `${baseUrl}/shops/business_ownerships/getPermission?shop_id=${props.shop_id}`,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        )
        .then((response) => {
            console.log(response);
            permission.value = response.data.data;
            loading.value = false;
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
        });
});

const togglePermission = (event, shopId, permissionKey) => {
    console.log(permissionKey);

    let token = localStorage.getItem("token");
    const isChecked = event.target.checked;
    console.log(isChecked);

    const payload = {
        shop_id: shopId,
        [permissionKey]: isChecked,
    };

  
    axios
        .post(
            `${baseUrl}/shops/business_ownerships/givePermission`, payload,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        )
        .then((response) => {
            permission.value = response.data.data;
            console.log("Permission updated:", response.data);
            toast.success('Permission changed successfully');

        })

        .catch((error) => {
            event.target.checked = !isChecked;
            loading.value = false;
            console.log("Error updating permission", error);
        });
};
</script>

<style scoped>
.switch {
    font-size: 17px;
    position: relative;
    display: inline-block;
    width: 3.5em;
    height: 2em;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    border: 1px solid #adb5bd;
    transition: 0.4s;
    border-radius: 30px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 1.4em;
    width: 1.4em;
    border-radius: 20px;
    left: 0.27em;
    bottom: 0.25em;
    background-color: #adb5bd;
    transition: 0.4s;
}

input:checked+.slider {
    background-color: green;
    border: 1px solid green;
}

input:focus+.slider {
    box-shadow: 0 0 1px green;
}

input:checked+.slider:before {
    transform: translateX(1.4em);
    background-color: #fff;
}
</style>
