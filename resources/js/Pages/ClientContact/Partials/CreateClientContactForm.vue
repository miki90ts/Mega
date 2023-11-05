<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    clients: {
        type: Object,
    },
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
    form.reset();
};

const form = useForm({
    client_id: "",
    first_name: "",
    last_name: "",
    phone: "",
    job_title: "",
    email: "",
});

const savaClientContact = () => {
    form.post(route("client.contacts.store"), {
        onFinish: () => {
            form.reset();
            closeModal();
            router.reload({ only: ["clientContacts"] });
        },
    });
};
</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 px-4 pt-2">
                Dodaj Kontakt
            </h2>
        </header>
        <form @submit.prevent="savaClientContact" class="mt-6 p-4">
            <div class="grid gap-2">
                <div>
                    <InputLabel for="client_id" value="Klijent" />

                    <SelectInput
                        v-model="form.client_id"
                        keyIndex="id"
                        valueIndex="id"
                        labelIndex="name"
                        :data="clients"
                        id="client_id"
                        class="mt-1 block w-full"
                        required
                        :show-choose="true"
                    ></SelectInput>

                    <InputError class="mt-2" :message="form.errors.client_id" />
                </div>
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
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div>
                    <InputLabel for="phone" value="Telefon" />

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
                    <InputLabel for="job_title" value="Funkcija" />

                    <TextInput
                        id="job_title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.job_title"
                        autocomplete="job_title"
                    />

                    <InputError class="mt-2" :message="form.errors.job_title" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
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
                        class="px-6 py-2 text-md bg-blue-500 hover:bg-blue-600 text-white rounded focus:outline-none"
                    >
                        Потврдите
                    </button>
                </div>
            </div>
        </form>
    </section>
</template>

<style lang="scss" scoped></style>
