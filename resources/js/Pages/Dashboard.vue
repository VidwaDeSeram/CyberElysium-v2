<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold mb-4">Students</h2>
                        <div>
                            <Link
                                :href="route('students.create')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
                            >
                                Add Student
                            </Link>
                        </div>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Image</th>
                                    <th class="px-4 py-2">Age</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="student in students"
                                    :key="student.id"
                                >
                                    <td class="border px-4 py-2">
                                        {{ student.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <img
                                            :src="`${student.image}`"
                                            alt="Student Image"
                                            class="w-16 h-16 object-cover"
                                        />
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ student.age }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <span
                                            v-if="student.status"
                                            class="bg-green-500 text-white px-2 py-1 rounded"
                                            >Active</span
                                        >
                                        <span
                                            v-else
                                            class="bg-red-500 text-white px-2 py-1 rounded"
                                            >Inactive</span
                                        >
                                    </td>
                                    <td class="border px-4 py-2">
                                        <Link
                                            :href="
                                                route(
                                                    'students.edit',
                                                    student.id
                                                )
                                            "
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            >Edit</Link
                                        >
                                        <Link
                                            :href="
                                                route(
                                                    'students.destroy',
                                                    student.id
                                                )
                                            "
                                            method="delete"
                                            as="button"
                                            class="text-red-500 hover:text-red-700"
                                            >Delete</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    students: Array,
});
</script>
