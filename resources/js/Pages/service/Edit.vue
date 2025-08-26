<template>
  <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ message }}</h1>

    <form @submit.prevent="form.put(route('service.update', service.id))">
      <!-- Name -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full border rounded px-3 py-2"
          placeholder="Service Name"
        />
        <span v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</span>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Description</label>
        <textarea
          v-model="form.description"
          class="w-full border rounded px-3 py-2"
          placeholder="Service Description"
        ></textarea>
        <span v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</span>
      </div>

      <!-- Price -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Price</label>
        <input
          v-model="form.price"
          type="number"
          step="0.01"
          class="w-full border rounded px-3 py-2"
          placeholder="Service Price"
        />
        <span v-if="form.errors.price" class="text-red-500 text-sm">{{ form.errors.price }}</span>
      </div>

      <!-- Category -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Category</label>
        <select v-model="form.category" class="w-full border rounded px-3 py-2">
          <option value="">Select Category</option>
          <option value="planned">Planned</option>
          <option value="unplanned">Unplanned</option>
        </select>
        <span v-if="form.errors.category" class="text-red-500 text-sm">{{ form.errors.category }}</span>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Update Service
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

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
</script>
