<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Event Type Details</h1>

    <div class="mb-2">
      <strong>Name:</strong> {{ eventType.name }}
    </div>
    <div class="mb-2">
      <strong>Category:</strong> {{ eventType.category }}
    </div>

    <router-link href="/eventtype/create" class="text-blue-500 underline">
      Create New Event Type
    </router-link>
  </div>
</template>

<script setup>
const props = defineProps({
  eventType: Object
})
</script>
