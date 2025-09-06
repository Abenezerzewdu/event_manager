<template>
  <div class="max-w-lg p-6 mx-auto mt-6 bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ user.name }}</h1>

    <p class="mb-2"><strong>Email:</strong> {{ user.email }}</p>
    <p class="mb-2"><strong>Phone:</strong> {{ user.phone || 'N/A' }}</p>
    <p class="mb-2"><strong>Role:</strong> {{ user.role || 'N/A' }}</p>
    <p class="mb-4"><strong>Admin:</strong> {{ user.is_admin ? 'Yes' : 'No' }}</p>

    <div class="space-x-2">
      <Link
        :href="route('user.edit', user.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600"
      >
        Edit
    </Link>

      <Link
        :href="route('user.index')"
        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
      >
        Back to List
    </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
  user: Object
});
</script>
