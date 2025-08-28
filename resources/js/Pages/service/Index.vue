<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Services</h1>
    <p>{{ message }}</p>

    <ul>
      <li v-for="service in services" :key="service.id">
        {{ service.name }} - ${{ service.price }}
        <button @click="destroy(service.id)" class="text-red-500 ml-2">Delete</button>
        <router-link :href="`/service/${service.id}/edit`" class="ml-2 text-blue-500">Edit</router-link>
      </li>
    </ul>

    <router-link href="/service/create" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Add Service</router-link>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';

defineProps({
  message: String,
  services: Array
});

function destroy(id) {
  if (confirm('Are you sure you want to delete this service?')) {
    Inertia.delete(route('service.destroy', id));
  }
}
</script>
