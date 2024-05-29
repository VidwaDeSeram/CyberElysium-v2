<template>
    <Head title="Edit Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Student
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
                                    @input="form.image = $event.target.files[0]"
                                    type="file"
                                    id="image"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                />
                                <div v-if="form.image" class="mt-2">
                                    <img
                                        :src="`/storage/${form.image}`"
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
                                >
                                    Update
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

const props = defineProps({
    student: Object,
});

const form = useForm({
    name: props.student.name,
    image: props.student.image,
    age: props.student.age,
    status: props.student.status,
});

const submitForm = () => {
    // Get the absolute path of the selected image file
    form.image = form.image ? form.image.path : null;

    // Submit the form
    form.put(route("students.update", props.student.id), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Student updated successfully!",
                showConfirmButton: false,
                timer: 1500,
            });
        },
        onError: (errors) => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: Object.values(errors).flat().join("<br>"),
                confirmButtonText: "OK",
            });
        },
    });
};
</script>
