<template>
  <div class="fixed inset-y-0 left-0 flex flex-col w-64 text-white bg-gray-800">
    <!-- Logo or Title --> evento🎈
    <div class="p-4 border-b border-gray-700">
      <h2 class="text-2xl font-bold">Admin Panel</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-2">
      <!-- <a href="/eventtype" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/eventtype') }">Event Types</a>
      <a href="/service" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/service') }">Services</a>
      <a href="/event" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/event') }">Events</a>
      <a href="/guest" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/guest') }">Guests</a>
      <a href="/vendor" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/vendor') }">Vendors</a>
      <a href="/user" class="block p-2 rounded hover:bg-gray-700" :class="{ 'bg-gray-700': isActive('/users') }">Users</a> -->
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

