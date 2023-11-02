<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateUserForm from "@/Pages/User/Partials/UpdateUserForm.vue";
import CreateUserForm from "@/Pages/User/Partials/CreateUserForm.vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3";

const showModal = ref(false);
const showUpdateModal = ref(false);
const selectedUser = ref(null);

defineProps({
    users: {
        type: Object,
    },
    countries: {
        type: Array,
    },
    job_positions: {
        type: Array,
    },
    genders: {
        type: Array,
    },
});

function openModal() {
    showModal.value = true;
}

function openUpdateModal(user) {
    showUpdateModal.value = true;
    selectedUser.value = user;
}

const closeModal = () => {
    showModal.value = false;
};

const closeUpdateModal = () => {
    showUpdateModal.value = false;
};
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Spisak zaposlenih u Megi
                </h2>
                <button
                    class="px-6 py-2 text-md bg-blue-500 hover:bg-blue-600 text-white rounded focus:outline-none ml-auto"
                    @click="openModal"
                >
                    Novi zaposleni
                </button>
            </div>
        </template>

        <Modal :show="showModal" @close="closeModal">
            <CreateUserForm
                :countries="countries"
                :job_positions="job_positions"
                :genders="genders"
                @close="closeModal"
            >
            </CreateUserForm>
        </Modal>

        <Modal :show="showUpdateModal" @close="closeUpdateModal">
            <UpdateUserForm
                :countries="countries"
                :job_positions="job_positions"
                :genders="genders"
                :user="selectedUser"
                @close="closeUpdateModal"
            ></UpdateUserForm>
        </Modal>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div
                        class="p-4 m-4 bg-white rounded-lg shadow-md grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2"
                    >
                        <div
                            v-for="user in users.data"
                            :key="user.id"
                            class="card border hover:shadow-none flex shadow-lg m-2 w-full p-3"
                            @click="openUpdateModal(user)"
                        >
                            <div
                                class="w-4/12 p-1 flex items-center justify-center"
                            >
                                <img
                                    class="w-20 h-20 p-1 bg-white rounded-full"
                                    :src="user.profile.photo"
                                    alt=""
                                />
                            </div>
                            <div class="w-8/12 p-1 break-words">
                                <p class="text-sky-800">
                                    {{ user.first_name }}
                                    {{ user.last_name }}
                                </p>
                                <p
                                    class="text-sm text-gray-400 mt-2"
                                    :class="{
                                        'text-yellow-500':
                                            user.profile.job_position.id === 1,
                                        'text-red-500':
                                            user.profile.job_position.id === 2,
                                        'text-blue-600':
                                            user.profile.job_position.id === 3,
                                        'text-green-500':
                                            user.profile.job_position.id === 4,
                                        'text-purple-500':
                                            user.profile.job_position.id === 5,
                                        'text-pink-500':
                                            user.profile.job_position.id === 6,
                                        'text-emerald-500':
                                            user.profile.job_position.id === 7,
                                        'text-slate-500':
                                            user.profile.job_position.id === 8,
                                    }"
                                >
                                    {{ user.profile.job_position.title }}
                                </p>
                                <p
                                    class="font-semibold text-sm italic dark break-words mt-2"
                                >
                                    {{ user.email }}
                                </p>
                                <p class="text-sm text-gray-400 mt-2">
                                    {{ user.profile.phone }}
                                </p>
                                <p class="text-sm text-gray-400 mt-2">
                                    {{ user.profile.mobile }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.dp__input {
    height: 41px;
}
</style>
