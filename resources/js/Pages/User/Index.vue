<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head } from "@inertiajs/vue3";

defineProps({
    users: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

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
