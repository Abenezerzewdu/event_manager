<template>
  <div class="max-w-2xl p-6 mx-auto mt-6 bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ message }}</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold">Event Name *</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full px-3 py-2 border rounded"
          required
        />
        <span v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Description</label>
        <textarea
          v-model="form.description"
          class="w-full px-3 py-2 border rounded"
          rows="3"
        ></textarea>
        <span v-if="form.errors.description" class="text-sm text-red-500">{{ form.errors.description }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Date *</label>
        <input
          v-model="form.date"
          type="date"
          class="w-full px-3 py-2 border rounded"
          required
        />
        <span v-if="form.errors.date" class="text-sm text-red-500">{{ form.errors.date }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Location *</label>
        <input
          v-model="form.location"
          type="text"
          class="w-full px-3 py-2 border rounded"
          required
        />
        <span v-if="form.errors.location" class="text-sm text-red-500">{{ form.errors.location }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Budget *</label>
        <input
          v-model="form.budget"
          type="number"
          step="0.01"
          class="w-full px-3 py-2 border rounded"
          required
        />
        <span v-if="form.errors.budget" class="text-sm text-red-500">{{ form.errors.budget }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Organizer *</label>
        <select
          v-model="form.user_id"
          class="w-full px-3 py-2 border rounded"
          required
        >
          <option value="">Select Organizer</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
        <span v-if="form.errors.user_id" class="text-sm text-red-500">{{ form.errors.user_id }}</span>
      </div>

      <div>
        <label class="block mb-1 font-semibold">Event Type *</label>
        <select
          v-model="form.event_type_id"
          class="w-full px-3 py-2 border rounded"
          required
        >
          <option value="">Select Event Type</option>
          <option v-for="eventType in eventTypes" :key="eventType.id" :value="eventType.id">
            {{ eventType.name }}
          </option>
        </select>
        <span v-if="form.errors.event_type_id" class="text-sm text-red-500">{{ form.errors.event_type_id }}</span>
      </div>

      <div class="flex space-x-2">
        <button
          type="submit"
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          :disabled="form.processing"
        >
          <span v-if="form.processing">Updating...</span>
          <span v-else>Update Event</span>
        </button>

        <Link
          :href="route('event.show', event.id)"
          class="px-4 py-2 text-gray-600 border rounded hover:bg-gray-100"
        >
          Cancel
        </Link>

      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
  event: Object,
  message: String,
  users: Array,
  eventTypes: Array,
  errors: Object
});

const form = useForm({
  name: props.event?.name || '',
  description: props.event?.description || '',
  date: props.event?.date ? new Date(props.event.date).toISOString().split('T')[0] : '',
  location: props.event?.location || '',
  budget: props.event?.budget || 0,
  user_id: props.event?.user_id || '',
  event_type_id: props.event?.event_type_id || ''
});

function submit() {
  form.put(route('event.update', props.event.id), {
    onSuccess: () => {
    }
  });
}
</script>
