<template>
  <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ message }}</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full border rounded px-3 py-2"
        />
        <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</span>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Category</label>
        <select v-model="form.category" class="w-full border rounded px-3 py-2">
          <option value="planned">Planned</option>
          <option value="unplanned">Unplanned</option>
        </select>
        <span v-if="errors.category" class="text-red-500 text-sm">{{ errors.category }}</span>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Update
      </button>
    </form>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  eventType: Object,
  message: String
});

const form = reactive({
  name: props.eventType.name,
  category: props.eventType.category
});

const errors = ref({});

function submit() {
  Inertia.put(route('eventtype.update', props.eventType.id), form, {
    onError: (err) => (errors.value = err)
  });
}
</script>

<style script>
/* Optional styling */
</style>
