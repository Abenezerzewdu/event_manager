<template>
  <div class="min-h-screen p-6 bg-gray-50">
    <!-- Navigation -->
    <nav class="mb-6 text-white bg-blue-800 shadow-lg">
      <div class="container flex items-center justify-between px-6 py-3 mx-auto">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
          </svg>
          <span class="text-xl font-semibold tracking-tight">Vendor Service Manager</span>
        </div>
        <div class="flex space-x-4">
          <Link :href="route('vendor-service.create')" class="px-3 py-2 text-sm font-medium rounded-md hover:bg-blue-700">Create Vendor Service</Link>
        </div>
      </div>
    </nav>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ vendorServices.length }}</h3>
            <p class="text-gray-600">Total Vendor Services</p>
          </div>
        </div>
      </div>
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ uniqueVendorsCount }}</h3>
            <p class="text-gray-600">Unique Vendors</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendor Services Table -->
    <div class="overflow-hidden bg-white rounded-lg shadow">
      <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
        <h2 class="text-xl font-semibold text-blue-800">All Vendor Services</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Vendor</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Service</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Created At</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="vendorService in vendorServices" :key="vendorService.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ vendorService.vendor ? vendorService.vendor.company_name : 'N/A' }}</div>
                    <div class="text-sm text-gray-500">ID: {{ vendorService.vendor_id }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ vendorService.service ? vendorService.service.name : 'N/A' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{ formatDate(vendorService.created_at) }}</div>
              </td>
              <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                <div class="flex space-x-2">
                  <Link :href="route('vendor-service.show', vendorService.id)" class="p-1 text-blue-600 rounded-full hover:text-blue-900 hover:bg-blue-100" title="View">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </Link>
                  <Link :href="route('vendor-service.edit', vendorService.id)" class="p-1 text-indigo-600 rounded-full hover:text-indigo-900 hover:bg-indigo-100" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </Link>
                  <button @click="deleteVendorService(vendorService.id)" class="p-1 text-red-600 rounded-full hover:text-red-900 hover:bg-red-100" title="Delete">
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
  vendorServices: {
    type: Array,
    default: () => [],
  },
});

const uniqueVendorsCount = computed(() => {
  const vendorIds = new Set(props.vendorServices.map((vs) => vs.vendor_id));
  return vendorIds.size;
});

const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  if (isNaN(date.getTime())) return 'Invalid date';
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return date.toLocaleDateString(undefined, options);
};

const deleteVendorService = (vendorServiceId) => {
  if (!confirm('Are you sure you want to delete this vendor service?')) return;

  router.delete(route('vendor-service.destroy', vendorServiceId), {
    onSuccess: () => {
      router.visit(route('vendor-service.index'));
    },
    onError: (errors) => {
      alert('Error deleting vendor service: ' + (errors.message || 'Unknown error'));
    },
  });
};
</script>

