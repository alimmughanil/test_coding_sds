<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

const categories = usePage().props.categories;
const article = usePage().props.article;

const form = useForm({
    _method: "PUT",
    category_id: article.category_id,
    title: article.title,
    slug: article.slug,
    content: article.content,
    banner: article.banner,
});
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
            <div
                class="btn btn-sm btn-primary w-max btn-outline cursor-default"
            >
                Create Article
            </div>
            <div class="w-full md:max-w-md">
                <form @submit.prevent="form.post(`/article/${article.id}`)">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Category</span>
                        </label>
                        <select
                            v-model="form.category_id"
                            class="select select-bordered w-full"
                        >
                            <option selected value="">Choose Category</option>
                            <option
                                v-for="category in categories"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.category_id"
                                >{{ form.errors.category_id }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Type here"
                            class="input input-bordered w-full"
                            v-model="form.title"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.title"
                                >{{ form.errors.title }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Slug</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Auto Type From Title"
                            class="input input-bordered w-full"
                            v-model="form.slug"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.slug"
                                >{{ form.errors.slug }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Content</span>
                        </label>
                        <textarea
                            class="textarea textarea-bordered textarea-lg"
                            placeholder="Type here"
                            v-model="form.content"
                        ></textarea>
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.content"
                                >{{ form.errors.content }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Banner</span>
                        </label>
                        <input
                            type="file"
                            placeholder="Type here"
                            class="file-input file-input-bordered w-full"
                            @input="form.banner = $event.target.files[0]"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.banner"
                                >{{ form.errors.banner }}</span
                            >
                        </label>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm"
                        :disabled="form.processing"
                    >
                        Create
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
