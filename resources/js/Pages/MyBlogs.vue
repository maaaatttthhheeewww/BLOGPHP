,
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <AuthenticatedLayout>

        <Head title="My Blogs" />
        <div class="max-w-3xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-8">My Authored Blogs</h1>
            <div v-if="sortedBlogs.length > 0" class="grid grid-cols-1 gap-6">
                <div v-for="blog in sortedBlogs" :key="blog.id"
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ blog.title }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ blog.content }}</p>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">{{ new
                            Date(blog.created_at).toLocaleString() }}</p>
                        <div class="flex justify-end mt-4">
                            <button @click="editBlog(blog)"
                                class="mr-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Edit
                            </button>
                            <button @click="deleteBlog(blog.id)"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center text-gray-500 dark:text-gray-400">You haven't authored any blogs yet.</div>
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
            // Sort blogs array by created_at timestamp in descending order
            return this.blogs.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        },
    },
    methods: {
        editBlog(blog) {
            // Add your logic to navigate to the edit page for the selected blog
            console.log("Editing blog:", blog);
        },
        deleteBlog(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                // Make a DELETE request to the route using Inertia.js
                this.$inertia.delete(route('DestroyBlog', id))
                    .then(() => {
                        // Optionally, you can handle success response here
                        // For example, show a success message or reload the page
                        // Example: this.$toast.success('Blog deleted successfully!');
                        // Example: this.$inertia.reload();
                    })
                    .catch((error) => {
                        // Handle error response here
                        console.error('Error deleting blog:', error);
                    });
            }
        }
    }
};
</script>
