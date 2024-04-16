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
                    <div v-if="!blog.editing" class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ blog.title }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ blog.content }}</p>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">{{ new
                            Date(blog.created_at).toLocaleString() }}</p>
                        <div class="flex justify-end mt-4">
                            <button @click="toggleEditing(blog)" class="edit-button">Edit</button>
                            <button @click="deleteBlog(blog.id)"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                Delete
                            </button>
                        </div>
                    </div>
                    <div v-else class="p-6">
                        <input v-model="blog.editedTitle" type="text"
                            class="edit-title mb-2 block w-full dark:bg-gray-700" />
                        <textarea v-model="blog.editedContent"
                            class="edit-content mb-2 block w-full dark:bg-gray-700"></textarea>
                        <input v-model="blog.editedPublished" type="checkbox" class="edit-published" />
                        <div class="flex justify-end">
                            <button @click="saveChanges(blog)" class="save-button mr-2">Save</button>
                            <button @click="cancelEditing(blog)" class="cancel-button">Cancel</button>
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
            return this.blogs.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        },
    },
    methods: {
        toggleEditing(blog) {
            blog.editing = !blog.editing;
            blog.editedTitle = blog.title;
            blog.editedContent = blog.content;
            blog.editedPublished = blog.published;
        },
        saveChanges(blog) {
            const data = {
                title: blog.editedTitle,
                content: blog.editedContent,
                published: blog.editedPublished
            };
            this.$inertia.patch(route('UpdateBlog', blog.id), data)
                .then(() => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.error('Error updating blog:', error);
                });
        },
        cancelEditing(blog) {
            blog.editing = false;
        },
        deleteBlog(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                this.$inertia.delete(route('DestroyBlog', id))
                    .then(() => {
                        //FIGURE THIS OUT
                    })
                    .catch((error) => {
                        console.error('Error deleting blog:', error);
                    });
            }
        }
    }
};
</script>
