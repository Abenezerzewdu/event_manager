<template>
  <div class="p-6">
    <h1>{{ message }}</h1>



    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="border p-2 w-full" />
      </div>

      <div class="mb-4">
        <label>Category:</label>
        <select v-model="form.category" class="border p-2 w-full">
          <option value="">Select Category</option>
          <option value="Planned">Planned</option>
          <option value="Unplanned">Unplanned</option>
        </select>


      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        Submit
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  message: String
})

const form = reactive({
  name: '',
  category: ''
})

function submitForm() {
  if (!form.name || !form.category) {
    alert("Please fill all fields!");
    return;
  }

  Inertia.post('/eventtype/', form, {
    onSuccess: () => {
      console.log('Form submitted successfully');
    },
    onError: (errors) => {
      console.log('Form submission errors:', errors);
    }
  });
}
</script>
