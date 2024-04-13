<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<style>
.btn-primary {
  padding: 0.75rem 1.5rem;
  background-color: #FF2D20;
  color: #fff;
  border-radius: 0.375rem;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #E11D0E;
}
</style>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    <div class="max-w-2xl px-6 lg:max-w-7xl">
      <header class="py-10">
        <div class="flex justify-center">
          <nav v-if="canLogin" class="flex justify-center space-x-4">
            <template v-if="$page.props.auth.user">
              <Link
                :href="route('dashboard')"
                class="btn-primary"
              >
                Dashboard
              </Link>
            </template>
            <template v-else>
              <Link
                :href="route('login')"
                class="btn-primary"
              >
                Log in
              </Link>
              <template v-if="canRegister">
                <Link
                  :href="route('register')"
                  class="btn-primary"
                >
                  Register
                </Link>
              </template>
            </template>
          </nav>
        </div>
      </header>

      <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
      </footer>
    </div>
  </div>
</template>
