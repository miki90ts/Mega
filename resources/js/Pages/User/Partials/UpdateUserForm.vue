<script setup>
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const props = defineProps({
    countries: {
        type: Array,
    },
    job_positions: {
        type: Array,
    },
    genders: {
        type: Array,
    },
    user: {
        type: Object,
    },
});

const emit = defineEmits(["close"]);

const updateUser = (user) => {
    form.post(route("user.update", user), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        //onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    emit("close");

    form.reset();
};

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const form = useForm({
    _method: "patch",
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    phone: props.user.profile.phone ?? "",
    mobile: props.user.profile.mobile ?? "",
    address: props.user.profile.address ?? "",
    city: props.user.profile.city ?? "",
    country_id:
        props.user.profile.country_id !== null
            ? String(props.user.profile.country_id)
            : "",
    job_position_id: String(props.user.profile.job_position_id) ?? "1",
    birthday: props.user.profile.birthday ?? "",
    gender:
        props.user.profile.gender !== null
            ? String(props.user.profile.gender)
            : "",
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 px-4 pt-2">
                Izmeni zaposlenog
            </h2>
        </header>

        <form @submit.prevent="updateUser(user)" class="mt-6 p-4">
            <div class="grid md:grid-cols-2 gap-2">
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
            </div>

            <div class="mt-8 sm:flex sm:flex-row-reverse">
                <div class="w-full mx-auto text-center">
                    <button
                        type="button"
                        class="px-6 py-2 text-md bg-gray-500 hover:bg-gray-600 text-white rounded mr-5 focus:outline-none"
                        @click.stop="closeModal"
                    >
                        Откажите
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2 text-md bg-blue-500 hover:bg-blue-600 text-white rounded focus:outline-none ml-auto"
                    >
                        Потврдите
                    </button>
                </div>
            </div>
        </form>
    </section>
</template>
