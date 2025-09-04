<template>
  <div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">

        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
          <div class="flex items-center">
            <div class="p-2 mr-3 bg-white rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <div>
              <h1 class="text-2xl font-bold text-white">Edit Event Service</h1>
              <p class="text-blue-100">Update the details of the event service</p>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="p-6">
          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

              <!-- Event -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">Event *</label>
                <select v-model="form.event_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="">Select Event</option>
                  <option v-for="event in events" :key="event.id" :value="event.id">
                    {{ event.title }}
                  </option>
                </select>
                <span v-if="form.errors.event_id" class="mt-1 text-sm text-red-500">{{ form.errors.event_id }}</span>
              </div>

              <!-- Service -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">Service *</label>
                <select v-model="form.service_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="">Select Service</option>
                  <option v-for="service in services" :key="service.id" :value="service.id">
                    {{ service.name }}
                  </option>
                </select>
                <span v-if="form.errors.service_id" class="mt-1 text-sm text-red-500">{{ form.errors.service_id }}</span>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

              <!-- Vendor -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">Vendor *</label>
                <select v-model="form.vendor_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="">Select Vendor</option>
                  <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">
                    {{ vendor.company_name }}
                  </option>
                </select>
                <span v-if="form.errors.vendor_id" class="mt-1 text-sm text-red-500">{{ form.errors.vendor_id }}</span>
              </div>

              <!-- Status -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">Status *</label>
                <select v-model="form.status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="pending">Pending</option>
                  <option value="confirmed">Confirmed</option>
                  <option value="done">Done</option>
                </select>
                <span v-if="form.errors.status" class="mt-1 text-sm text-red-500">{{ form.errors.status }}</span>
              </div>
            </div>

            <!-- Notes -->
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Notes</label>
              <textarea v-model="form.notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Additional notes..."></textarea>
              <span v-if="form.errors.notes" class="mt-1 text-sm text-red-500">{{ form.errors.notes }}</span>
            </div>

            <!-- Actions -->
            <div class="flex pt-6 space-x-4 border-t">
              <button type="submit" class="flex items-center px-6 py-3 text-white bg-green-500 rounded-lg hover:bg-green-600" :disabled="form.processing">
                <span v-if="form.processing">Updating...</span>
                <span v-else>Update Event Service</span>
              </button>
              <Link :href="route('event-service.show', eventService.id)" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</Link>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3';

const props = defineProps({
  eventService: Object,
  events: Array,
  services: Array,
  vendors: Array,
});

const form = useForm({
  event_id: props.eventService.event_id || '',
  service_id: props.eventService.service_id || '',
  vendor_id: props.eventService.vendor_id || '',
  status: props.eventService.status || 'pending',
  notes: props.eventService.notes || '',
});

function submit() {
  form.clearErrors();
  form.put(route('event-service.update', props.eventService.id), {
    onSuccess: () => {
      router.visit(route('event-service.show', props.eventService.id));
    },
  });
}
</script>
