<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    applications: {
        type: Object,
    },
    clients: {
        type: Array,
    },
    query: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Aplikacije" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Spisak Aplikacija {{ applications.data }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 m-4 bg-white rounded-lg shadow-md grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2"
                >
                    <div
                        v-if="applications.meta.total"
                        v-for="application in applications.data"
                        :key="application.id"
                        class="card border hover:shadow-none shadow-lg m-2 w-full break-words"
                    >
                        <div
                            class="bg-emerald-600 border-b-2 border-neutral-800 px-6 py-3 font-semibold text-xl text-white"
                        >
                            {{ application.name }}
                        </div>
                        <p class="text-sky-500 mt-2 p-2 flex">
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
                            {{ application.client.name }}
                        </p>
                        <div>
                            <div
                                v-for="server in application.servers"
                                :key="server.id"
                            >
                                {{ server }}
                            </div>
                        </div>
                    </div>
                    <div v-else>Nema aplikacija</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
