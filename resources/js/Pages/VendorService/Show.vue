<template>
  <div class="max-w-4xl p-6 mx-auto mt-6 bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-3xl font-bold text-gray-800">{{ vendorService.vendor ? vendorService.vendor.company_name : 'N/A' }} - {{ vendorService.service ? vendorService.service.name : 'N/A' }}</h1>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Vendor Information</h3>
          <p><strong>Name:</strong> {{ vendorService.vendor ? vendorService.vendor.company_name : 'N/A' }}</p>
          <p><strong>ID:</strong> {{ vendorService.vendor_id }}</p>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-500">Service Information</h3>
          <p><strong>Name:</strong> {{ vendorService.service ? vendorService.service.name : 'N/A' }}</p>
          <p><strong>ID:</strong> {{ vendorService.service_id }}</p>
        </div>
      </div>

      <div class="space-y-4">
        <div>
          <h3 class="text-sm font-semibold text-gray-500">Timestamps</h3>
          <p class="text-sm"><strong>Created:</strong> {{ new Date(vendorService.created_at).toLocaleDateString() }}</p>
          <p class="text-sm"><strong>Updated:</strong> {{ new Date(vendorService.updated_at).toLocaleDateString() }}</p>
        </div>
      </div>
    </div>

    <div class="flex mt-8 space-x-3">
      <Link
        :href="route('vendor-service.edit', vendorService.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600"
      >
        Edit Vendor Service
      </Link>

      <Link
        :href="route('vendor-service.index')"
        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
      >
        Back to Vendor Services
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  vendorService: Object,
});
</script>

