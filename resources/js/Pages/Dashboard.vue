<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button @click="navigateToRoute('BlogCreateRoute')"
                            class="text-blue-500 hover:text-blue-700">Create a
                            Blog</button>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button @click="navigateToRoute('MyBlogs')" class="text-blue-500 hover:text-blue-700">See Your
                            Blogs</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
const navigateToRoute = (routeName) => {
    window.location.href = route(routeName);
}
</script>