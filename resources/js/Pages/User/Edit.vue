<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

const categories = usePage().props.categories;
const user = usePage().props.user;

const form = useForm({
    _method: "PUT",
    name: user.name,
    email: user.email,
    role: user.role,
    password: null,
});
</script>

<template>
    <Head name="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                User
            </h2>
        </template>
        <div class="flex justify-center py-6 flex-col items-center gap-4">
            <div
                class="btn btn-sm btn-primary w-max btn-outline cursor-default"
            >
                Edit User
            </div>
            <div class="w-full md:max-w-md">
                <form @submit.prevent="form.post(`/user/${user.id}`)">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Type here"
                            class="input input-bordered w-full"
                            v-model="form.name"
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
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            type="email"
                            placeholder="Type here"
                            class="input input-bordered w-full"
                            v-model="form.email"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.email"
                                >{{ form.errors.email }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input
                            type="password"
                            placeholder="Type here"
                            class="input input-bordered w-full"
                            v-model="form.password"
                        />
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.password"
                                >{{ form.errors.password }}</span
                            >
                        </label>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Role</span>
                        </label>
                        <select
                            v-model="form.role"
                            class="select select-bordered w-full"
                        >
                            <option selected value="">Choose Role</option>
                            <option value="Author">Author</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <label class="label">
                            <span
                                class="label-text-alt text-error"
                                v-if="form.errors.role"
                                >{{ form.errors.role }}</span
                            >
                        </label>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm"
                        :disabled="form.processing"
                    >
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
