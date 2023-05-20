<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";

const users = usePage().props.users;

const destroy = (id) => {
    router.delete(`/user/${id}`);
};
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                User
            </h2>
        </template>
        <div class="flex justify-center py-6 flex-col items-center gap-4">
            <Link class="btn btn-sm btn-primary w-max" :href="'/user/create'">
                Create User
            </Link>
            <div class="w-max">
                <div class="overflow-x-auto">
                    <table class="table table-compact w-full text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="" v-if="users.length == 0">
                                <td colspan="5">Nothing data</td>
                            </tr>
                            <tr v-for="(user, index) in users">
                                <th>{{ index + 1 }}</th>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.role }}</td>
                                <td class="flex flex-row gap-2">
                                    <Link
                                        class="btn btn-xs btn-primary"
                                        :href="`/user/${user.id}/edit`"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="destroy(user.id)"
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
