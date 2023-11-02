<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modals/Modal.vue";
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3";

import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    mobile: "",
    address: "",
    city: "",
    country_id: "162",
    job_position_id: "1",
    birthday: "",
    gender: "",
    password_confirmation: "",
    password: "",
});

const showModal = ref(false);
const showUpdateModal = ref(false);

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

function openUpdateModal() {
    showUpdateModal.value = true;
}

const closeModal = () => {
    showModal.value = false;
};

const closeUpdateModal = () => {
    showUpdateModal.value = false;
};

const save = () => {
    form.post(route("user.store"), {
        onFinish: () => {
            form.reset();
            closeModal();
            router.reload({ only: ["users"] });
        },
    });
};
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profile
                </h2>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-auto"
                    @click="openModal"
                >
                    Novi zaposleni
                </button>
            </div>
        </template>

        <Modal :showModal="showModal" @modal-close="closeModal" @action="save">
            <form
                @submit.prevent="form.patch(route('user.profile.update'))"
                class="grid md:grid-cols-2 gap-2"
            >
                <div>
                    <InputLabel for="first_name" value="Ime" />

                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        required
                        autofocus
                        autocomplete="first_name"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.first_name"
                    />
                </div>

                <div>
                    <InputLabel for="last_name" value="Prezime" />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autofocus
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="birthday" value="Datum rođenja" />
                    <VueDatePicker
                        v-model="form.birthday"
                        auto-apply
                        :enable-time-picker="false"
                        :format="format"
                        :max-date="new Date()"
                        required
                        class="mt-1 block w-full"
                    ></VueDatePicker>

                    <InputError class="mt-2" :message="form.errors.birthday" />
                </div>

                <div>
                    <InputLabel for="gender" value="Pol" />

                    <SelectInput
                        v-model="form.gender"
                        keyIndex="value"
                        valueIndex="value"
                        labelIndex="label"
                        :data="genders"
                        id="gender"
                        class="mt-1 block w-full"
                        required
                        :show-choose="true"
                    ></SelectInput>

                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>

                <div>
                    <InputLabel for="phone" value="Lokal" />

                    <TextInput
                        id="phone"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        required
                        autocomplete="phone"
                    />

                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>

                <div>
                    <InputLabel for="mobile" value="Mobilni" />

                    <TextInput
                        id="mobile"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.mobile"
                        autocomplete="mobile"
                    />

                    <InputError class="mt-2" :message="form.errors.mobile" />
                </div>

                <div>
                    <InputLabel for="address" value="Adresa" />

                    <TextInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address"
                        autocomplete="address"
                    />

                    <InputError class="mt-2" :message="form.errors.address" />
                </div>

                <div>
                    <InputLabel for="city" value="Grad" />

                    <TextInput
                        id="city"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.city"
                        autocomplete="city"
                    />

                    <InputError class="mt-2" :message="form.errors.city" />
                </div>

                <div>
                    <InputLabel for="country_id" value="Država" />

                    <SelectInput
                        v-model="form.country_id"
                        keyIndex="id"
                        valueIndex="id"
                        labelIndex="title"
                        :data="countries"
                        id="country_id"
                        class="mt-1 block w-full"
                        required
                        :show-choose="true"
                    ></SelectInput>

                    <InputError
                        class="mt-2"
                        :message="form.errors.country_id"
                    />
                </div>

                <div>
                    <InputLabel for="job_position_id" value="Radno mesto" />

                    <SelectInput
                        v-model="form.job_position_id"
                        keyIndex="id"
                        valueIndex="id"
                        labelIndex="title"
                        :data="job_positions"
                        id="job_position_id"
                        class="mt-1 block w-full"
                        required
                    ></SelectInput>

                    <InputError
                        class="mt-2"
                        :message="form.errors.job_position_id"
                    />
                </div>

                <div>
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>
            </form>
        </Modal>

        <Modal
            :showModal="showUpdateModal"
            @modal-close="closeUpdateModal"
            @action="save"
        >
            1
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
                            @click="openUpdateModal"
                        >
                            <div
                                class="w-4/12 p-1 flex items-center justify-center"
                            >
                                <img
                                    class="w-20 h-20 p-1 bg-white rounded-full"
                                    src="https://www.medianama.com/wp-content/uploads/2018/04/Facebook-shadow.jpg.jpg"
                                    alt=""
                                />
                            </div>
                            <div class="w-8/12 p-1 break-words">
                                <div class="text-sky-800">
                                    {{ user.first_name }}
                                    {{ user.last_name }}
                                </div>
                                <p
                                    class="text-sm text-gray-400"
                                    :class="{
                                        'text-yellow-500':
                                            user.profile.job_position.id === 1,
                                        'text-red-500':
                                            user.profile.job_position.id === 2,
                                        'text-blue-500':
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
                                <div
                                    class="font-semibold text-sm italic dark break-words"
                                >
                                    {{ user.email }}
                                </div>
                                <p class="text-sm text-gray-400">
                                    {{ user.profile.phone }}
                                </p>
                                <p class="text-sm text-gray-400">
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
