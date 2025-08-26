<template>
  <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ message }}</h1>

    <div class="mb-4">
      <inertia-link
        href="{{ route('service.create') }}"
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
      >
        Create New Service
      </inertia-link>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">ID</th>
          <th class="border px-4 py-2">Name</th>
          <th class="border px-4 py-2">Description</th>
          <th class="border px-4 py-2">Price</th>
          <th class="border px-4 py-2">Category</th>
          <th class="border px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="service in services" :key="service.id">
          <td class="border px-4 py-2">{{ service.id }}</td>
          <td class="border px-4 py-2">{{ service.name }}</td>
          <td class="border px-4 py-2">{{ service.description }}</td>
          <td class="border px-4 py-2">${{ service.price }}</td>
          <td class="border px-4 py-2">{{ service.category }}</td>
          <td class="border px-4 py-2 space-x-2">
            <!-- Show button -->
            <inertia-link
              :href="route('service.show', service.id)"
              class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
            >
              View
            </inertia-link>

            <!-- Edit button -->
            <inertia-link
              :href="route('service.edit', service.id)"
              class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
            >
              Edit
            </inertia-link>

            <!-- Delete button -->
            <button
              @click="destroy(service.id)"
              class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  services: Array,
  message: String
});

// Delete service function
function destroy(id) {
  if (confirm('Are you sure you want to delete this service?')) {
    Inertia.delete(route('service.destroy', id));
  }
}
</script>
