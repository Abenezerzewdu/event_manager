<template>
  <div class="fixed inset-y-0 left-0 flex flex-col w-64 text-white bg-gray-800">
    <!-- Logo or Title -->
    <div class="p-4 border-b border-gray-700">
      <h2 class="text-2xl font-bold">Admin Panel</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-2">
      <a href="/event-types" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/event-types') }">Event Types</a>
      <a href="/services" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/services') }">Services</a>
      <a href="/events" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/events') }">Events</a>
      <a href="/guests" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/guests') }">Guests</a>
      <a href="/vendors" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/vendors') }">Vendors</a>
      <a href="/users" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/users') }">Users</a>
      <a href="/reviews" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/reviews') }">Reviews</a>
    </nav>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const page = usePage();
const isActive = (path) => {
  return page.url.startsWith(path);
};
</script>

