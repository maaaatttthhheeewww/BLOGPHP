<script setup>
import { VMarkdownView } from 'vue3-markdown'
import 'vue3-markdown/dist/style.css'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <AuthenticatedLayout>

        <Head title="My Blogs" />
        <div class="max-w-3xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-8">Published Blogs</h1>
            <div v-if="sortedBlogs.length > 0" class="grid grid-cols-1 gap-6">
                <div v-for="blog in sortedBlogs" :key="blog.id"
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="!blog.editing" class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ blog.title }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ blog.content }}</p>
                        <!-- <VMarkdownView :content="blog.content" /> -->
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">{{ new
                            Date(blog.created_at).toLocaleString() }}</p>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">{{ blog.user.name }}</p>
                    </div>
                </div>
            </div>
            <div v-else class="text-center text-gray-500 dark:text-gray-400">There aren't any published blogs yet.</div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        blogs: {
            type: Array,
            required: true
        }
    },
    computed: {
        sortedBlogs() {
            return this.blogs.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        },
    },
    components: {
        VMarkdownView
    }
};
</script>
