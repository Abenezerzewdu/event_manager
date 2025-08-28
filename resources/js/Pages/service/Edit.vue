<template>
  <div class="p-6">
    <h1>{{ message }}</h1>

    <form @submit.prevent="submitForm" class="max-w-md mx-auto mt-6">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Description:</label>
        <textarea v-model="form.description" class="border p-2 w-full"></textarea>
      </div>

      <div class="mb-4">
        <label>Price:</label>
        <input v-model="form.price" type="number" step="0.01" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Category:</label>
        <select v-model="form.category" class="border p-2 w-full">
          <option value="">Select Category</option>
          <option value="planned">Planned</option>
          <option value="unplanned">Unplanned</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">
        <span v-if="form.processing">Updating...</span>
        <span v-else>Update</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  service: Object,
  message: String
});

const form = useForm({
  name: props.service.name,
  description: props.service.description,
  price: props.service.price,
  category: props.service.category
});

function submitForm() {
  form.put(`/service/${props.service.id}`);
}
</script>
