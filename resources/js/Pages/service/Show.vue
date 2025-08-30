<template>
  <div class="max-w-lg p-6 mx-auto mt-6 bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ service.name }}</h1>

    <p class="mb-2"><strong>Name:</strong> {{ service.name }}</p>
    <p class="mb-2"><strong>Description:</strong> {{ service.description || 'N/A' }}</p>
    <p class="mb-2"><strong>Price:</strong> ${{ service.price.toFixed(2) }}</p>
    <p class="mb-2"><strong>Category:</strong> {{ service.category || 'N/A' }}</p>
    <p class="mb-4"><strong>Created At:</strong> {{ new Date(service.created_at).toLocaleDateString() }}</p>

    <div class="space-x-2">
      <Link
        :href="route('service.edit', service.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600"
      >
        Edit
      </Link>

      <Link
        :href="route('service.index')"
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
  service: Object
});
</script>
