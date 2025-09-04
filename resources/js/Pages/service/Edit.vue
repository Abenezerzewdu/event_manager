<template>
  <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-2xl px-4 mx-auto">
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl">
          <i class="text-2xl text-white fa-solid fa-pen-to-square"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Edit Service</h1>
        <p class="mt-2 text-gray-600">Update your service details</p>
      </div>

      <!-- Form Card -->
      <div class="p-8 bg-white shadow-lg rounded-xl">
        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Name Field -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              <i class="mr-2 text-blue-500 fa-solid fa-tag"></i>
              Service Name <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <input v-model="form.name" type="text" required
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                :class="{'border-red-500': errors.name, 'border-gray-300': !errors.name}"
                placeholder="Enter service name"
                @blur="validateField('name')">
              <div v-if="errors.name" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
              </div>
            </div>
            <div v-if="errors.name" class="flex items-center mt-2 text-sm text-red-600">
              <i class="mr-1 fa-solid fa-circle-info"></i>
              {{ errors.name }}
            </div>
          </div>

          <!-- Description Field -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              <i class="mr-2 text-blue-500 fa-solid fa-file-lines"></i>
              Description <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <textarea v-model="form.description" required
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                :class="{'border-red-500': errors.description, 'border-gray-300': !errors.description}"
                rows="4" placeholder="Describe the service in detail"
                @blur="validateField('description')"></textarea>
              <div v-if="errors.description" class="absolute top-3 right-3">
                <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
              </div>
            </div>
            <div v-if="errors.description" class="flex items-center mt-2 text-sm text-red-600">
              <i class="mr-1 fa-solid fa-circle-info"></i>
              {{ errors.description }}
            </div>
          </div>

          <!-- Price and Category Row -->
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Price Field -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">
                <i class="mr-2 text-blue-500 fa-solid fa-dollar-sign"></i>
                Price ($) <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input v-model="form.price" type="number" step="0.01" min="0" required
                  class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  :class="{'border-red-500': errors.price, 'border-gray-300': !errors.price}"
                  placeholder="0.00"
                  @blur="validateField('price')">
                <div v-if="errors.price" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                </div>
              </div>
              <div v-if="errors.price" class="flex items-center mt-2 text-sm text-red-600">
                <i class="mr-1 fa-solid fa-circle-info"></i>
                {{ errors.price }}
              </div>
            </div>

            <!-- Category Field -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">
                <i class="mr-2 text-blue-500 fa-solid fa-list"></i>
                Category <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <select v-model="form.category" required
                  class="w-full px-4 py-3 border rounded-lg appearance-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  :class="{'border-red-500': errors.category, 'border-gray-300': !errors.category}"
                  @change="validateField('category')"
                  @blur="validateField('category')">
                  <option value="">Select Category</option>
                  <option value="planned">Planned</option>
                  <option value="unplanned">Unplanned</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <i class="text-gray-400 fa-solid fa-chevron-down"></i>
                </div>
                <div v-if="errors.category" class="absolute inset-y-0 flex items-center pr-3 pointer-events-none right-8">
                  <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                </div>
              </div>
              <div v-if="errors.category" class="flex items-center mt-2 text-sm text-red-600">
                <i class="mr-1 fa-solid fa-circle-info"></i>
                {{ errors.category }}
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex pt-4 space-x-4">
            <button type="submit"
              :disabled="form.processing"
              class="flex items-center justify-center flex-1 px-6 py-4 text-white transition-all duration-200 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-75">
              <i v-if="form.processing" class="mr-2 fa-solid fa-circle-notch fa-spin"></i>
              <i v-else class="mr-2 fa-solid fa-floppy-disk"></i>
              <span v-if="form.processing">Updating Service...</span>
              <span v-else>Update Service</span>
            </button>

            <Link :href="route('service.index')" class="flex items-center justify-center px-6 py-4 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
              <i class="mr-2 fa-solid fa-times"></i>
              Cancel
            </Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3';
import { reactive } from "vue";
import Sidebar from '@/Components/Sidebar.vue';
const props = defineProps({
  service: Object,
  message: String,
  serverErrors: Object
});

// Initialize form
const form = useForm({
  name: props.service?.name || '',
  description: props.service?.description || '',
  price: props.service?.price || 0,
  category: props.service?.category || ''
});

// Initialize validation errors
const errors = reactive({
  name: '',
  description: '',
  price: '',
  category: ''
});

// Sync server errors with our validation
if (props.serverErrors) {
  Object.keys(props.serverErrors).forEach(key => {
    if (errors.hasOwnProperty(key)) {
      errors[key] = props.serverErrors[key][0];
    }
  });
}

// Field validation function
function validateField(field) {
  switch(field) {
    case 'name':
      errors.name = form.name.trim() === '' ? 'Please enter a service name' : '';
      break;
    case 'description':
      errors.description = form.description.trim() === '' ? 'Please enter a description' : '';
      break;
    case 'price':
      if (form.price === '' || form.price === null) {
        errors.price = 'Please enter a price';
      } else if (parseFloat(form.price) < 0) {
        errors.price = 'Price cannot be negative';
      } else {
        errors.price = '';
      }
      break;
    case 'category':
      errors.category = form.category === '' ? 'Please select a category' : '';
      break;
  }
}

// Form submission
function submitForm() {
  // Validate all fields before submission
  validateField('name');
  validateField('description');
  validateField('price');
  validateField('category');

  // Check if there are any validation errors
  const hasErrors = Object.values(errors).some(error => error !== '');

  if (hasErrors) {
    return; // Don't submit if there are validation errors
  }

  form.put(route('service.update', props.service.id), {
    onSuccess: () => {
      // Clear any existing errors on successful submission
      Object.keys(errors).forEach(key => errors[key] = '');
      router.visit(route('service.show', props.service.id));
    },
    onError: (serverErrors) => {
      // Handle server-side validation errors
      if (serverErrors) {
        Object.keys(serverErrors).forEach(key => {
          if (errors.hasOwnProperty(key)) {
            errors[key] = serverErrors[key];
          }
        });
      }
    }
  });
}
</script>
