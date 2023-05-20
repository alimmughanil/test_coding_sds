<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";

const articles = usePage().props.articles;

const destroy = (id) => {
    router.delete(`/article/${id}`);
};
</script>

<template>
    <Head title="Article" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Article
            </h2>
        </template>
        <div class="flex justify-center py-6 flex-col items-center gap-4">
            <Link
                class="btn btn-sm btn-primary w-max"
                :href="'/article/create'"
            >
                Create Article
            </Link>
            <div class="w-max">
                <div class="overflow-x-auto">
                    <table class="table table-compact w-full text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="" v-if="articles.length == 0">
                                <td colspan="5">Nothing data</td>
                            </tr>
                            <tr v-for="(article, index) in articles">
                                <th>{{ index + 1 }}</th>
                                <td>{{ article.title }}</td>
                                <td>{{ article.category.name }}</td>
                                <td>{{ article.slug }}</td>
                                <td class="flex flex-row gap-2">
                                    <Link
                                        class="btn btn-xs btn-primary"
                                        :href="`/article/${article.slug}`"
                                    >
                                        Show
                                    </Link>
                                    <Link
                                        class="btn btn-xs btn-primary"
                                        :href="`/article/${article.id}/edit`"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="destroy(article.id)"
                                        class="btn btn-xs btn-error"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Category</th>
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
