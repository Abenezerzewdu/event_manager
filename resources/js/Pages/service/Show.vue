<template>
  <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">{{ service.name }}</h1>
        <p class="mt-2 text-gray-600">Service Details</p>
      </div>

      <!-- Service Card -->
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
          <h2 class="text-xl font-semibold text-gray-800">Service Information</h2>
        </div>

        <div class="p-6">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="space-y-4">
              <div>
                <h3 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Name</h3>
                <p class="mt-1 text-lg font-medium text-gray-900">{{ service.name }}</p>
              </div>

              <div>
                <h3 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Description</h3>
                <p class="mt-1 text-gray-700">{{ service.description || 'No description available' }}</p>
              </div>
            </div>

            <div class="space-y-4">
              <div>
                <h3 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Price</h3>
                <p class="mt-1 text-2xl font-bold text-blue-600">${{ service.price.toFixed(2) }}</p>
              </div>

              <div>
                <h3 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Category</h3>
                <span v-if="service.category" class="inline-flex items-center px-3 py-1 mt-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full">
                  {{ service.category }}
                </span>
                <p v-else class="mt-1 text-gray-600">N/A</p>
              </div>

              <div>
                <h3 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Created At</h3>
                <p class="mt-1 text-gray-600">{{ new Date(service.created_at).toLocaleDateString() }}</p>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col pt-6 mt-8 space-y-4 border-t border-gray-200 sm:flex-row sm:space-y-0 sm:space-x-4">
            <Link
              :href="route('service.edit', service.id)"
              class="inline-flex items-center justify-center px-4 py-2 text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 hover:shadow-lg"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit Service
            </Link>

            <Link
              :href="route('service.index')"
              class="inline-flex items-center justify-center px-4 py-2 text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 hover:shadow-lg"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Back to List
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  service: Object
});
</script>
