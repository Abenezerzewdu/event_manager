<template>
  <div class="max-w-4xl p-6 mx-auto mt-6 bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-3xl font-bold text-gray-800">{{ vendor.company_name }}</h1>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Contact Information</h3>
          <p class="mt-1"><strong>Email:</strong> {{ vendor.contact_email }}</p>
          <p><strong>Phone:</strong> {{ vendor.phone }}</p>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-500">Status</h3>
          <span :class="`inline-flex px-3 py-1 text-sm font-semibold leading-5 rounded-full ${getStatusColor(vendor.status)}`">
            {{ vendor.status }}
          </span>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-500">User Account</h3>
          <p>{{ vendor.user ? vendor.user.name : 'N/A' }} (ID: {{ vendor.user_id }})</p>
        </div>
      </div>

      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Description</h3>
          <p class="mt-1 text-gray-700">{{ vendor.description || 'No description provided.' }}</p>
        </div>

        <div v-if="vendor.vendors_file">
          <h3 class="text-sm font-semibold text-gray-500">Attached File</h3>
          <a :href="`/storage/${vendor.vendors_file}`" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            View File
          </a>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-500">Timestamps</h3>
          <p class="text-sm"><strong>Created:</strong> {{ new Date(vendor.created_at).toLocaleDateString() }}</p>
          <p class="text-sm"><strong>Updated:</strong> {{ new Date(vendor.updated_at).toLocaleDateString() }}</p>
        </div>
      </div>
    </div>

    <div class="flex mt-8 space-x-3">
      <Link
        :href="route('vendor.edit', vendor.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600"
      >
        Edit Vendor
      </Link>

      <Link
        :href="route('vendor.index')"
        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
      >
        Back to Vendors
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
  vendor: Object
});

const getStatusColor = (status) => {
  const colors = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'approved': 'bg-green-100 text-green-800',
    'rejected': 'bg-red-100 text-red-800'
  };
  return colors[status] || 'bg-gray-100 text-gray-800';
};
</script>
