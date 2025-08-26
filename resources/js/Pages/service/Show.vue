<template>
  <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ service.name }}</h1>

    <p class="mb-2"><strong>Description:</strong> {{ service.description || 'N/A' }}</p>
    <p class="mb-2"><strong>Price:</strong> ${{ service.price }}</p>
    <p class="mb-4"><strong>Category:</strong> {{ service.category || 'N/A' }}</p>

    <div class="space-x-2">
      <inertia-link
        :href="route('service.edit', service.id)"
        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
      >
        Edit
      </inertia-link>

      <inertia-link
        href="{{ route('service.index') }}"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Back to List
      </inertia-link>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  service: Object
});
</script>
