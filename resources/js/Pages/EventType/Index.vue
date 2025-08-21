<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Event Types</h1>
    <p>{{ message }}</p>

    <!-- Example list -->
    <ul>
      <li v-for="(event, index) in eventTypes" :key="index">{{ event.name }}</li>
    </ul>
  </div>
</template>

<script setup>
console.log('Hello world')
defineProps({
  message: String,
  eventTypes: Array // This will come from the controller
})
</script>
