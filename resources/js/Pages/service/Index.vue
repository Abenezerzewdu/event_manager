<template>
  <div class="min-h-screen p-6 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-5xl mx-auto">
      <!-- Header with Add Button -->
      <div class="flex flex-col mb-8 sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-6 text-center sm:text-left sm:mb-0">
          <h1 class="text-3xl font-bold text-gray-800">Service Management</h1>
          <p class="mt-2 text-gray-600">Manage all your services in one place</p>
        </div>
        <div class="flex justify-center sm:justify-end">
          <Link
            :href="route('service.create')"
            class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Service
          </Link>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <div class="p-5 bg-white border-l-4 border-blue-500 shadow-md rounded-xl">
          <div class="flex items-center">
            <div class="p-3 mr-4 bg-blue-100 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-gray-800">{{ services.length }}</p>
              <p class="text-sm text-gray-600">Total Services</p>
            </div>
          </div>
        </div>

        <div class="p-5 bg-white border-l-4 border-green-500 shadow-md rounded-xl">
          <div class="flex items-center">
            <div class="p-3 mr-4 bg-green-100 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-gray-800">{{ services.filter(s => s.status === 'active').length }}</p>
              <p class="text-sm text-gray-600">Active Services</p>
            </div>
          </div>
        </div>

        <div class="p-5 bg-white border-l-4 border-purple-500 shadow-md rounded-xl">
          <div class="flex items-center">
            <div class="p-3 mr-4 bg-purple-100 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-gray-800">${{ services.reduce((sum, s) => sum + parseFloat(s.price), 0).toFixed(2) }}</p>
              <p class="text-sm text-gray-600">Total Value</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Services List -->
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
          <h2 class="text-xl font-semibold text-gray-800">All Services</h2>
        </div>

        <div v-if="services.length > 0" class="divide-y divide-gray-100">
          <div v-for="service in services" :key="service.id" class="flex items-center justify-between p-6 transition-all duration-300 hover:bg-blue-50 hover:shadow-inner">
            <div class="flex-1">
              <div class="flex items-start">
                <div class="flex-shrink-0 p-3 mr-4 bg-blue-100 rounded-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-800">{{ service.name }}</h3>
                  <p class="mt-1 font-medium text-blue-600">${{ service.price }}</p>
                  <p v-if="service.description" class="mt-2 text-sm text-gray-600 line-clamp-1">{{ service.description }}</p>
                </div>
              </div>
            </div>

            <div class="flex space-x-2">
              <!-- View Button -->
              <Link
                :href="route('service.show', service.id)"
                class="p-3 text-green-600 transition-colors transform rounded-full hover:text-green-800 hover:bg-green-50 hover:scale-110"
                title="View Details"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </Link>

              <!-- Edit Button -->
              <Link
                :href="route('service.edit', service.id)"
                class="p-3 text-blue-600 transition-colors transform rounded-full hover:text-blue-800 hover:bg-blue-50 hover:scale-110"
                title="Edit"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </Link>

              <!-- Delete Button -->
              <button
                @click="destroy(service.id)"
                class="p-3 text-red-600 transition-colors transform rounded-full hover:text-red-800 hover:bg-red-50 hover:scale-110"
                title="Delete"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div v-else class="p-12 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="mt-4 text-lg font-medium text-gray-900">No services found</h3>
          <p class="mt-2 text-gray-500">Get started by creating your first service.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
defineProps({
  message: String,
  services: Array
});

function destroy(id) {
  if (confirm('Are you sure you want to delete this service?')) {
    router.delete(route('service.destroy', id), {
      onSuccess: () => {
        // Optional: Add any success handling here
      }
    });
  }
}
</script>


