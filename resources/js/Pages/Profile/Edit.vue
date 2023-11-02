<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateUserProfileInformation from "./Partials/UpdateUserProfileInformation.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
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
    user: {
        type: Object,
    },
});

const form = useForm({
    _method: "patch",
    photo: "",
});

const fileInput = ref(null);
const avatar = ref(props.user.profile.photo);

const openFileInput = () => {
    fileInput.value.click();
};

const handleFileChange = () => {
    avatar.value = URL.createObjectURL(form.photo);
    form.post(route("user.profile.image.update"));

    // const formData = new FormData();
    // formData.append("profile_picture", file);

    // axios.post("/api/upload-profile-image", formData).then((response) => {
    //     toastr.success("Image uploaded successfully!");
    // });
};
</script>

<style>
.profile-user-img:hover {
    background-color: blue;
    cursor: pointer;
}
</style>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 m-4 bg-white rounded-lg shadow-md grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2"
                >
                    <div class="text-center">
                        <input
                            type="file"
                            @input="form.photo = $event.target.files[0]"
                            accept="image/*"
                            class="hidden"
                            id="photo"
                            ref="fileInput"
                            @change="handleFileChange"
                        />

                        <img
                            @click="openFileInput"
                            class="w-20 h-20 p-1 bg-white rounded-full"
                            :src="avatar"
                            alt="User profile picture"
                        />
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateUserProfileInformation
                        :countries="countries"
                        :job_positions="job_positions"
                        :genders="genders"
                        :user="user"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
