<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Create Blog" />
    <AuthenticatedLayout>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h1 class="card-title mb-0">Create New Blog Post</h1>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title:</label>
                                    <input type="text" id="title" class="form-control form-control-lg"
                                        v-model="formData.title" placeholder="Enter your blog title..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content:</label>
                                    <textarea id="content" class="form-control" v-model="formData.content" rows="10"
                                        placeholder="Write your blog post here..." required></textarea>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" id="published" class="form-check-input"
                                        v-model="formData.published">
                                    <label for="published" class="form-check-label">Publish</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Publish Blog
                                    Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                title: '',
                content: '',
                published: false
            }
        };
    },
    methods: {
        submitForm() {
            if (!this.formData.title || !this.formData.content) {
                alert('Please fill in all fields');
                return;
            }

            axios.post('/blogs', this.formData)
                .then(response => {
                    console.log(response.data);
                    this.formData = {
                        title: '',
                        content: '',
                        published: false
                    };
                    alert('Blog post created successfully!');
                })
                .catch(error => {
                    console.error(error);
                    alert('An error occurred while creating the blog post');
                });
        }
    }
};
</script>

<style scoped>
/* Component-specific styles */

/* Form container */
.container {
    min-height: 100vh;
}

/* Card styles */
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Card header */
.card-header {
    border-radius: 15px 15px 0 0;
}

/* Form inputs */
.form-control {
    border-radius: 15px;
}

/* Submit button */
.btn-primary {
    border-radius: 15px;
}
</style>
