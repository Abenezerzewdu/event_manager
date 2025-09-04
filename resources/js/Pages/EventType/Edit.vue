<template>
  <div class="max-w-lg p-6 mx-auto bg-white rounded shadow">
    <h1 class="mb-4 text-2xl font-bold">{{ message }}</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full px-3 py-2 border rounded"
        />
        <span v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</span>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Category</label>
        <select v-model="form.category" class="w-full px-3 py-2 border rounded">
          <option value="planned">Planned</option>
          <option value="unplanned">Unplanned</option>
        </select>
        <span v-if="form.errors.category" class="text-sm text-red-500">{{ form.errors.category }}</span>
      </div>

      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
        Update
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  eventType: Object,
  message: String
});

const form = useForm({
  name: props.eventType?.name || '',
  category: props.eventType?.category || ''
});

function submit() {
  form.put(route('eventtype.update', props.eventType.id), {
    onSuccess: () => {
      router.visit(route('eventtype.index'));
    }
  });
}
</script>
