
<template>
  <div class="min-h-screen p-6 bg-gray-50">
    <!-- Navigation -->
    <nav class="mb-6 text-white bg-blue-800 shadow-lg">
      <div class="container flex items-center justify-between px-6 py-3 mx-auto">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-xl font-semibold tracking-tight">Guest Manager</span>
        </div>
        <div class="flex space-x-4">
          <Link :href="route('guest.create')" class="px-3 py-2 text-sm font-medium rounded-md hover:bg-blue-700">Create Guest</Link>
        </div>
      </div>
    </nav>

    <!-- Success message display -->
    <!-- <div v-if="$page.props.flash.success" class="p-4 mb-4 text-green-800 rounded-lg bg-green-50">
      {{ $page.props.flash.success }}
    </div> -->

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ guests.length }}</h3>
            <p class="text-gray-600">Total Guests</p>
          </div>
        </div>
      </div>
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ attendingGuestsCount }}</h3>
            <p class="text-gray-600">Attending Guests</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Guests Table -->
    <div class="overflow-hidden bg-white rounded-lg shadow">
      <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
        <h2 class="text-xl font-semibold text-blue-800">All Guests</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Phone</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Event</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Attending</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Created At</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="guest in guests" :key="guest.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ guest.name }}</div>
                    <div class="text-sm text-gray-500">ID: {{ guest.id }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ guest.email || 'N/A' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ guest.phone }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ guest.event ? guest.event.title : 'N/A' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ guest.is_attending ? 'Yes' : 'No' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{ formatDate(guest.created_at) }}</div>
              </td>
              <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                <div class="flex space-x-2">
                  <Link :href="route('guest.show', guest.id)" class="p-1 text-blue-600 rounded-full hover:text-blue-900 hover:bg-blue-100" title="View">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </Link>
                  <Link :href="route('guest.edit', guest.id)" class="p-1 text-indigo-600 rounded-full hover:text-indigo-900 hover:bg-indigo-100" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </Link>
                  <button @click="deleteGuest(guest.id)" class="p-1 text-red-600 rounded-full hover:text-red-900 hover:bg-red-100" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  guests: {
    type: Array,
    default: () => [],
  },
  flash: Object,
});

const attendingGuestsCount = computed(() => {
  return props.guests.filter((guest) => guest.is_attending).length;
});

const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  if (isNaN(date.getTime())) return 'Invalid date';
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return date.toLocaleDateString(undefined, options);
};

const deleteGuest = (guestId) => {
  if (!confirm('Are you sure you want to delete this guest?')) return;

  router.delete(route('guest.destroy', guestId), {
    onSuccess: () => {
      router.visit(route('guest.index'), { method: 'get' });
    },
    onError: (errors) => {
      alert('Error deleting guest: ' + (errors.message || 'Unknown error'));
    },
  });
};
</script>
