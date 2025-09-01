<template>
  <div class="max-w-2xl p-6 mx-auto mt-6 bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ vendor.company_name }}</h1>

    <div class="space-y-3">
      <p><strong>Contact Email:</strong> {{ vendor.contact_email }}</p>
      <p><strong>Phone:</strong> {{ vendor.phone }}</p>
      <p><strong>User Account:</strong> {{ vendor.user?.name }} (ID: {{ vendor.user_id }})</p>
      <p><strong>Created At:</strong> {{ new Date(vendor.created_at).toLocaleDateString() }}</p>
      <p><strong>Updated At:</strong> {{ new Date(vendor.updated_at).toLocaleDateString() }}</p>
    </div>

    <div class="mt-6 space-x-2">
      <Link
        :href="route('vendor.edit', vendor.id)"
        class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600"
      >
        Edit
      </Link>

      <Link
        :href="route('vendor.index')"
        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
      >
        Back to List
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  vendor: Object
});
</script>
