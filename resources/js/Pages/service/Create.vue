<template>
  <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-2xl px-4 mx-auto">
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl">
          <i class="text-2xl text-white fa-solid fa-gear"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Create New Service</h1>
        <p class="mt-2 text-gray-600">Add a new service to your catalog</p>
      </div>

      <!-- Form Card -->
      <div class="p-8 bg-white shadow-lg rounded-xl">
        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Name Field -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              <i class="mr-2 text-blue-500 fa-solid fa-tag"></i>
              Service Name
            </label>
            <div class="relative">
              <input v-model="form.name" type="text"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter service name">
              <div v-if="form.errors.name" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
              </div>
            </div>
            <div v-if="form.errors.name" class="flex items-center mt-2 text-sm text-red-600">
              <i class="mr-1 fa-solid fa-circle-info"></i>
              {{ form.errors.name }}
            </div>
          </div>

          <!-- Description Field -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              <i class="mr-2 text-blue-500 fa-solid fa-file-lines"></i>
              Description
            </label>
            <div class="relative">
              <textarea v-model="form.description"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                rows="4" placeholder="Describe the service in detail"></textarea>
              <div v-if="form.errors.description" class="absolute top-3 right-3">
                <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
              </div>
            </div>
            <div v-if="form.errors.description" class="flex items-center mt-2 text-sm text-red-600">
              <i class="mr-1 fa-solid fa-circle-info"></i>
              {{ form.errors.description }}
            </div>
          </div>

          <!-- Price and Category Row -->
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Price Field -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">
                <i class="mr-2 text-blue-500 fa-solid fa-dollar-sign"></i>
                Price
              </label>
              <div class="relative">
                <input v-model="form.price" type="number" step="0.01"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="0.00">
                <div v-if="form.errors.price" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                </div>
              </div>
              <div v-if="form.errors.price" class="flex items-center mt-2 text-sm text-red-600">
                <i class="mr-1 fa-solid fa-circle-info"></i>
                {{ form.errors.price }}
              </div>
            </div>

            <!-- Category Field -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">
                <i class="mr-2 text-blue-500 fa-solid fa-list"></i>
                Category
              </label>
              <div class="relative">
                <select v-model="form.category"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="">Select Category</option>
                  <option value="planned">Planned</option>
                  <option value="unplanned">Unplanned</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <i class="text-gray-400 fa-solid fa-chevron-down"></i>
                </div>
                <div v-if="form.errors.category" class="absolute inset-y-0 flex items-center pr-3 pointer-events-none right-8">
                  <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                </div>
              </div>
              <div v-if="form.errors.category" class="flex items-center mt-2 text-sm text-red-600">
                <i class="mr-1 fa-solid fa-circle-info"></i>
                {{ form.errors.category }}
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button type="submit"
              :disabled="form.processing"
              class="flex items-center justify-center w-full px-6 py-4 text-white transition-all duration-200 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-75">
              <i v-if="form.processing" class="mr-2 fa-solid fa-circle-notch fa-spin"></i>
              <i v-else class="mr-2 fa-solid fa-plus"></i>
              <span v-if="form.processing">Creating Service...</span>
              <span v-else>Create Service</span>
            </button>
          </div>
        </form>
      </div>

      <!-- Additional Info -->
      <div class="flex items-center justify-center mt-8 space-x-6 text-sm text-gray-500">
        <div class="flex items-center">
          <i class="mr-2 fa-solid fa-shield-alt"></i>
          <span>Secure form</span>
        </div>
        <div class="flex items-center">
          <i class="mr-2 fa-solid fa-clock"></i>
          <span>Takes less than 2 minutes</span>
        </div>
      </div>
    </div>
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
  form.post(route('service.store'), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.log('Errors:', errors);
    }
  });
}
</script>
