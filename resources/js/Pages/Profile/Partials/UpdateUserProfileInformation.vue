<script setup>
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

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const form = useForm({
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
            <h2 class="text-lg font-medium text-gray-900"></h2>
        </header>

        <form
            @submit.prevent="form.patch(route('user.profile.update'))"
            class="mt-6 space-y-6"
        >
            <div class="mt-4">
                <InputLabel for="birthday" value="Datum rođenja" />
                <VueDatePicker
                    v-model="form.birthday"
                    auto-apply
                    :enable-time-picker="false"
                    :format="format"
                    :max-date="new Date()"
                    required
                ></VueDatePicker>

                <InputError class="mt-2" :message="form.errors.birthday" />
            </div>

            <div class="mt-4">
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

            <div class="mt-4">
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

            <div class="mt-4">
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

            <div class="mt-4">
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

            <div class="mt-4">
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

                <InputError class="mt-2" :message="form.errors.country_id" />
            </div>

            <div class="mt-4">
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

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
