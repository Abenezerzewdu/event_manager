<template>
  <div class="p-6">
    <h1>{{ message }}</h1>

    <form @submit.prevent="submitForm" class="max-w-md mx-auto mt-6">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="w-full p-2 border"/>
                <!-- <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div> -->

      </div>

      <div class="mb-4">
        <label>Description:</label>
        <textarea v-model="form.description" class="w-full p-2 border"></textarea>
                <div v-if="form.errors.description" class="text-sm text-red-500">{{ form.errors.description }}</div>

      </div>

      <div class="mb-4">
        <label>Price:</label>
        <input v-model="form.price" type="number" step="0.01" class="w-full p-2 border"/>
                <div v-if="form.errors.price" class="text-sm text-red-500">{{ form.errors.price }}</div>

      </div>

      <div class="mb-4">
        <label>Category:</label>
        <select v-model="form.category" class="w-full p-2 border">
          <option value="">Select Category</option>
          <option value="planned">Planned</option>
          <option value="unplanned">Unplanned</option>
        </select>
                <div v-if="form.errors.category" class="text-sm text-red-500">{{ form.errors.category }}</div>

      </div>

      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded" :disabled="form.processing">
        <span v-if="form.processing">Submitting...</span>
        <span v-else>Submit</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  message: String,
   errors: Object
});
const form = useForm({
  name: '',
  description: '',
  price: 0,
  category: ''
});

function submitForm() {
  form.post(route('service.store'), { // Use route() instead of hardcoded URL
    onSuccess: () => {
      // Optional: Reset form or redirect
      form.reset();
    },
    onError: (errors) => {
      console.log('Errors:', errors);
    }
  });
}
</script>
