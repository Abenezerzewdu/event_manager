<template>
  <div class="max-w-lg p-6 mx-auto mt-6 bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ eventType.name }}</h1>

    <p class="mb-2"><strong>Name:</strong> {{ eventType.name }}</p>
    <p class="mb-2"><strong>Category:</strong> {{ eventType.category || 'N/A' }}</p>
    <p class="mb-4"><strong>Created At:</strong> {{ new Date(eventType.created_at).toLocaleDateString() }}</p>

    <div class="space-x-2">
      <Link
        :href="route('eventtype.edit', eventType.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600"
      >
        Edit
      </Link>

      <Link
        :href="route('eventtype.index')"
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
  eventType: Object
});
</script>
