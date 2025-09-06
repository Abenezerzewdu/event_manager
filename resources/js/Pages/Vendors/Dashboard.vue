<template>
  <VendorLayout title="Dashboard">
    <div class="grid grid-cols-3 gap-4">
      <div class="p-4 bg-white rounded shadow">
        <h2 class="text-lg">Products</h2>
        <p class="text-3xl font-semibold">{{ stats.products }}</p>
      </div>
      <div class="p-4 bg-white rounded shadow">
        <h2 class="text-lg">Orders</h2>
        <p class="text-3xl font-semibold">{{ stats.orders }}</p>
      </div>
      <div class="p-4 bg-white rounded shadow">
        <h2 class="text-lg">Revenue</h2>
        <p class="text-3xl font-semibold">${{ stats.revenue }}</p>
      </div>
    </div>
  </VendorLayout>
</template>

<script setup>
import VendorLayout from '@/Layouts/VendorLayout.vue'

defineProps({
  vendor: Object,
  stats: Object
})
</script>
