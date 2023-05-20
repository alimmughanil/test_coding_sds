<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";

const categories = usePage().props.categories;

const destroy = (id) => {
    router.delete(`/category/${id}`);
};
</script>

<template>
    <Head title="Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Category
            </h2>
        </template>
        <div class="flex justify-center py-6 flex-col items-center gap-4">
            <Link
                class="btn btn-sm btn-primary w-max"
                :href="'/category/create'"
            >
                Create Category
            </Link>
            <div class="w-max">
                <div class="overflow-x-auto">
                    <table class="table table-compact w-full text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="" v-if="categories.length == 0">
                                <td colspan="4">Nothing data</td>
                            </tr>
                            <tr v-for="(category, index) in categories">
                                <th>{{ index + 1 }}</th>
                                <td>{{ category.name }}</td>
                                <td>{{ category.slug }}</td>
                                <td class="flex flex-row gap-2">
                                    <Link
                                        class="btn btn-xs btn-primary"
                                        :href="`/category/${category.id}/edit`"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="destroy(category.id)"
                                        class="btn btn-xs btn-error"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
