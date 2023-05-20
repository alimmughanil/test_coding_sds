<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    slug: null,
});

const setSlug = (e) => {
    form.slug = e.target.value.split(" ").join("-");
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
            <div
                class="btn btn-sm btn-primary w-max btn-outline cursor-default"
            >
                Create Category
            </div>
            <div class="w-full md:max-w-md">
                <form @submit.prevent="form.post('/category')">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Type here"
                            class="input input-bordered w-full"
                            v-model="form.name"
                            @input="setSlug($event)"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.name"
                                >{{ form.errors.name }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Slug</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Auto Type From Name"
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
