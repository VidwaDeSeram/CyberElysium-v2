<template>
    <Head :title="isEdit ? 'Edit Student' : 'Create Student'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                {{ isEdit ? "Edit Student" : "Create Student" }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label
                                    for="name"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2"
                                    >Name</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    id="name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                />
                            </div>

                            <div class="mb-4">
                                <label
                                    for="image"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2"
                                    >Image</label
                                >
                                <input
                                    @change="handleImageUpload"
                                    type="file"
                                    id="image"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                />
                                <div v-if="isEdit && form.image" class="mt-2">
                                    <img
                                        :src="form.image"
                                        alt="Student Image"
                                        class="w-32 h-32 object-cover"
                                    />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label
                                    for="age"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2"
                                    >Age</label
                                >
                                <input
                                    v-model.number="form.age"
                                    type="number"
                                    id="age"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                />
                            </div>

                            <div class="mb-4">
                                <label
                                    for="status"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2"
                                    >Status</label
                                >
                                <select
                                    v-model="form.status"
                                    id="status"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                >
                                    <option :value="true">Active</option>
                                    <option :value="false">Inactive</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-between">
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    :disabled="loading"
                                >
                                    <template v-if="loading">
                                        <svg
                                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        Processing...
                                    </template>
                                    <template v-else>
                                        {{ isEdit ? "Update" : "Create" }}
                                    </template>
                                </button>
                                <Link
                                    :href="route('dashboard')"
                                    class="text-blue-500 hover:text-blue-700"
                                    >Cancel</Link
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import axios from "axios";
import { ref } from "vue";

const props = defineProps({
    student: {
        type: Object,
        default: () => ({}),
    },
});

const isEdit = !!props.student.id;

const form = useForm({
    name: props.student.name || "",
    image: props.student.image || "",
    age: props.student.age || "",
    status: props.student.status || true,
});

const presignedUrl = ref("");
const r2url = ref("");
const selectedFile = ref(null);
const loading = ref(false);

const getPresignedUrl = async (fileName, domain, contentType) => {
    try {
        const response = await axios.post("/generate-presigned-url", {
            fileName,
            domain,
            contentType,
        });
        presignedUrl.value = response.data.presignedUrl;
        r2url.value = response.data.r2url;
    } catch (error) {
        console.error(
            "Error fetching presigned URL:",
            error.response?.data || error.message
        );
        Swal.fire({
            icon: "error",
            title: "Error fetching presigned URL",
            text: error.response?.data?.error || error.message,
        });
    }
};

const handleImageUpload = async (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        await getPresignedUrl(file.name, "students", file.type);
    } else {
        selectedFile.value = null;
    }
};

const uploadImage = async () => {
    if (selectedFile.value) {
        try {
            const response = await axios.put(
                presignedUrl.value,
                selectedFile.value,
                {
                    headers: {
                        "Content-Type": selectedFile.value.type,
                    },
                }
            );
            form.image = r2url.value;
        } catch (error) {
            console.error(
                "Error uploading image:",
                error.response?.data || error.message
            );
            Swal.fire({
                icon: "error",
                title: "Error uploading image",
                text: error.response?.data?.error || error.message,
            });
        }
    }
};

const submitForm = async () => {
    loading.value = true;

    if (selectedFile.value) {
        await uploadImage();
    } else if (!isEdit) {
        form.image = "";
    }

    if (isEdit) {
        form.put(route("students.update", props.student.id), {
            onSuccess: () => {
                Swal.fire({
                    icon: "success",
                    title: "Student updated successfully!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                loading.value = false;
            },
            onError: (errors) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: Object.values(errors).flat().join("<br>"),
                    confirmButtonText: "OK",
                });
                loading.value = false;
            },
        });
    } else {
        form.post(route("students.store"), {
            onSuccess: () => {
                Swal.fire({
                    icon: "success",
                    title: "Student created successfully!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                loading.value = false;
            },
            onError: (errors) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: Object.values(errors).flat().join("<br>"),
                    confirmButtonText: "OK",
                });
                loading.value = false;
            },
        });
    }
};
</script>
