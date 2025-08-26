<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Event Types</h1>
    <p>{{ message }}</p>
    <ul>
      <li v-for="(event, index) in eventTypes" :key="index">{{ event.name }}</li>
    </ul>

  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'

defineProps({
  message: String,
  eventTypes: Array
})
const page = usePage()

function destroy(id) {
  if (confirm('Are you sure you want to delete this event type?')) {
    Inertia.delete(route('eventtype.destroy', id));
  }
}
</script>

