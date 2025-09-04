<template>
  <div class="max-w-4xl p-6 mx-auto mt-6 bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-3xl font-bold text-gray-800">{{ guest.name }}</h1>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Guest Information</h3>
          <p><strong>Name:</strong> {{ guest.name }}</p>
          <p><strong>Email:</strong> {{ guest.email || 'N/A' }}</p>
          <p><strong>Phone:</strong> {{ guest.phone }}</p>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-500">Event Information</h3>
          <p><strong>Title:</strong> {{ guest.event ? guest.event.title : 'N/A' }}</p>
          <p><strong>ID:</strong> {{ guest.event_id }}</p>
        </div>
      </div>

      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Status</h3>
          <p><strong>Attending:</strong> {{ guest.is_attending ? 'Yes' : 'No' }}</p>
        </div>
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Timestamps</h3>
          <p class="text-sm"><strong>Created:</strong> {{ new Date(guest.created_at).toLocaleDateString() }}</p>
          <p class="text-sm"><strong>Updated:</strong> {{ new Date(guest.updated_at).toLocaleDateString() }}</p>
        </div>
      </div>
    </div>

    <div class="flex mt-8 space-x-3">
      <Link
        :href="route('guest.edit', guest.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600"
      >
        Edit Guest
      </Link>

      <Link
        :href="route('guest.index')"
        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
      >
        Back to Guests
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  guest: Object,
});
</script>

