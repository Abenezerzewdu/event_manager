<template>
  <div class="p-6">
    <h1 class="mb-4 text-2xl font-bold">Event Types</h1>
    <p class="mb-6 text-gray-600">{{ message }}</p>

    <ul>
      <li v-for="eventType in eventTypes" :key="eventType.id" class="flex items-center justify-between p-4 mb-3 transition-shadow bg-white border rounded-lg shadow-sm hover:shadow-md">
        <span class="text-lg font-medium text-gray-800">{{ eventType.name }}</span>

        <div class="flex space-x-2">
          <!-- Edit Button -->
          <Link
            :href="route('eventtype.edit', eventType.id)"
            class="p-2 text-blue-600 transition-colors rounded-full hover:text-blue-800 hover:bg-blue-50"
            title="Edit"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
          </Link>

          <!-- Delete Button -->
          <button
            @click="destroy(eventType.id)"
            class="p-2 text-red-600 transition-colors rounded-full hover:text-red-800 hover:bg-red-50"
            title="Delete"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        </div>
      </li>
    </ul>

    <Link
      :href="route('eventtype.create')"
      class="inline-flex items-center px-4 py-2 mt-6 text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Event Type
    </Link>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
  message: String,
  eventTypes: Array
});

function destroy(id) {
  if (confirm('Are you sure you want to delete this event type?')) {
    router.delete(route('eventtype.destroy', id), {
      onSuccess: () => {
        // Optional: Show success message or handle redirect
      }
    });
  }
}
</script>
