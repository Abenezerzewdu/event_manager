<template>
  <div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 text-white bg-gradient-to-r from-blue-500 to-blue-600">
          <h1 class="text-2xl font-bold">Event Service Details</h1>
        </div>

        <div class="px-6 py-6 space-y-4">
          <div>
            <span class="font-semibold">ID:</span> {{ eventService.id }}
          </div>
          <div>
            <span class="font-semibold">Event:</span> {{ eventService.event.title }}
          </div>
          <div>
            <span class="font-semibold">Service:</span> {{ eventService.service.name }}
          </div>
          <div>
            <span class="font-semibold">Vendor:</span> {{ eventService.vendor.company_name }}
          </div>
          <div>
            <span class="font-semibold">Status:</span> {{ eventService.status }}
          </div>
          <div v-if="eventService.notes">
            <span class="font-semibold">Notes:</span> {{ eventService.notes }}
          </div>

          <div class="pt-6 space-x-2 border-t">
            <Link :href="route('event-service.edit', eventService.id)" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Edit</Link>
            <Link :href="route('event-service.index')" class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">Back</Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  eventService: Object,
});
</script>
