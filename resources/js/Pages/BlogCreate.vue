<template>
  <AuthenticatedLayout>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow p-4">
            <div class="card-header bg-primary text-white">
              <h1 class="card-title mb-0">Create New Blog Post</h1>
            </div>
            <div class="card-body">
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label for="title" class="form-label text-white">Title:</label>
                  <input type="text" id="title" class="form-control wide" v-model="formData.title"
                    placeholder="Enter your blog title..." required>
                </div>
                <div class="mb-3">
                  <label for="content" class="form-label text-white">Content:</label>
                  <textarea id="content" class="form-control wide" v-model="formData.content" rows="10"
                    placeholder="Write your blog post here..." required></textarea>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" id="published" class="form-check-input" v-model="formData.published">
                  <label for="published" class="form-check-label text-white">Publish</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Create Blog</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const formData = ref({
  title: '',
  content: '',
  published: false,
});

const submitForm = () => {
  if (!formData.value.title || !formData.value.content) {
    alert('Please fill in all fields');
    return;
  }

  axios.post('/blogs', formData.value)
    .then(response => {
      console.log(response.data);
      formData.value.title = '';
      formData.value.content = '';
      formData.value.published = false;
      alert('Blog post created successfully!');
      window.location.href = '/dashboard';
    })
    .catch(error => {
      console.error(error);
      alert('An error occurred while creating the blog post');
    });
};
</script>

<style scoped>
/* Container styles */
.container {
  min-height: 80vh;
}

/* Card styles */
.card {
  border: none;
  border-radius: 15px;
}

/* Card header */
.card-header {
  border-radius: 15px 15px 0 0;
}

/* Form inputs */
.form-control {
  border-radius: 15px;
}

/* Set width of text inputs */
.wide {
  width: 100%;
}

/* Submit button */
.btn-primary {
  border-radius: 15px;
  color: white;
  background-color: #007bff;
  border-color: #007bff;
  font-size: 1rem;
  padding: 0.5rem 1rem;
}

/* On hover, darken the button */
.btn-primary:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}
</style>