<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref, watch } from "vue";
import { Head, router } from "@inertiajs/vue3";
import _debounce from "lodash.debounce";
import CreateClientContactForm from "./Partials/CreateClientContactForm.vue";
import UpdateClientContactForm from "./Partials/UpdateClientContactForm.vue";

const props = defineProps({
    clientContacts: {
        type: Object,
    },
    clients: {
        type: Object,
    },
    query: {
        type: Object,
    },
});

const showCreateModal = ref(false);
const showUpdateModal = ref(false);
const selectedClientContact = ref({});
const searchQuery = ref(props.query.search || "");

function openCreateModal() {
    showCreateModal.value = true;
}

function openUpdateModal(clientContact) {
    showUpdateModal.value = true;
    selectedClientContact.value = clientContact;
}

const closeCreateModal = () => {
    showCreateModal.value = false;
};

const closeUpdateModal = () => {
    showUpdateModal.value = false;
};

watch(searchQuery, (query) => {
    handleSearchInput(query);
});

const handleSearchInput = _debounce((query) => {
    router.reload({
        data: { search: query },
        preserveScroll: true,
    });
}, 500);
</script>

<template>
    <Head title="Kontakti od klijenta" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Kontakti od klijenata
                </h2>
                <div class="flex flex-grow space-x-3 justify-center">
                    <InputLabel for="search" value="Search" class="sr-only" />
                    <TextInput
                        type="search"
                        id="search"
                        class="w-3/6"
                        v-model="searchQuery"
                        placeholder="Pretraga kontakta..."
                    />
                </div>
                <button
                    class="px-6 py-2 text-md bg-blue-500 hover:bg-blue-600 text-white rounded focus:outline-none ml-auto"
                    @click="openCreateModal"
                >
                    Novi kontakt
                </button>
            </div>
        </template>

        <Modal :show="showCreateModal" @close="closeCreateModal">
            <CreateClientContactForm
                :clients="clients"
                @close="closeCreateModal"
            ></CreateClientContactForm>
        </Modal>

        <Modal :show="showUpdateModal" @close="closeUpdateModal">
            <UpdateClientContactForm
                :clients="clients"
                :clientContact="selectedClientContact"
                @close="closeUpdateModal"
            ></UpdateClientContactForm>
        </Modal>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 m-4 bg-white rounded-lg shadow-md grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2"
                >
                    <div
                        v-if="clientContacts.meta.total"
                        v-for="clientContact in clientContacts.data"
                        :key="clientContact.id"
                        class="card border hover:shadow-none flex shadow-lg m-2 w-full p-3"
                        @click="openUpdateModal(clientContact)"
                    >
                        <div class="p-1 break-words">
                            <p class="text-sky-800 flex">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 mr-2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"
                                    />
                                </svg>

                                {{ clientContact.client.name }}
                            </p>
                            <p class="text-sky-500 mt-2 flex">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 mr-2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                    />
                                </svg>
                                {{ clientContact.full_name }}
                            </p>
                            <p class="text-sm mt-2 text-emerald-500 flex">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 mr-2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"
                                    />
                                </svg>

                                {{ clientContact.job_title }}
                            </p>
                            <p class="text-sm text-gray-400 mt-2 flex">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 mr-2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"
                                    />
                                </svg>

                                {{ clientContact.phone }}
                            </p>
                            <p
                                class="font-semibold text-sm italic dark break-words mt-2 flex"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 mr-2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"
                                    />
                                </svg>
                                {{ clientContact.email }}
                            </p>
                        </div>
                    </div>
                    <div v-else>Nema kontakta</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
