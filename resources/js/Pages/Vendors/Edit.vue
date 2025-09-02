<template>
  <div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <div class="p-2 mr-3 bg-white rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </div>
              <div>
                <h1 class="text-2xl font-bold text-white">Edit Vendor</h1>
                <p class="text-blue-100">Update the details of the vendor</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="p-6">
          <!-- Success message display -->
          <div v-if="successMessage" class="p-4 mb-4 text-green-800 rounded-lg bg-green-50">
            {{ successMessage }}
          </div>

          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <!-- Company Name -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
                  Company Name *
                </label>
                <input
                  v-model="form.company_name"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter company name"
                  required
                />
                <span v-if="form.errors.company_name" class="mt-1 text-sm text-red-500">{{ form.errors.company_name }}</span>
              </div>

              <!-- Contact Email -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Contact Email *
                </label>
                <input
                  v-model="form.contact_email"
                  type="email"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter contact email"
                  required
                   @input="form.clearErrors('contact_email')"
                />
                <span v-if="form.errors.contact_email" class="mt-1 text-sm text-red-500">{{ form.errors.contact_email }}</span>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <!-- Phone -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  Phone Number *
                </label>
                <input
                  v-model="form.phone"
                  type="tel"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter phone number"
                  required
                  @input="()=>{validatePhoneNumber();form.clearErrors('phone');}"
                />
                <span v-if="form.errors.phone" class="mt-1 text-sm text-red-500">{{ form.errors.phone }}</span>
              </div>

              <!-- User Account -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  User Account *
                </label>
                <select
                  v-model="form.user_id"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                >
                  <option value="">Select User Account</option>
                  <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.name }} ({{ user.email }})
                  </option>
                </select>
                <span v-if="form.errors.user_id" class="mt-1 text-sm text-red-500">{{ form.errors.user_id }}</span>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex pt-6 space-x-4 border-t">
              <button
                type="submit"
                class="flex items-center px-6 py-3 text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
                :disabled="form.processing"
              >
                <svg v-if="form.processing" class="w-4 h-4 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ form.processing ? 'Updating Vendor...' : 'Update Vendor' }}
              </button>

              <Link
                :href="route('vendor.show', vendor.id)"
                class="flex items-center px-6 py-3 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Cancel
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  vendor: Object,
  users: Array,
});

const successMessage = ref('');

const form = useForm({
  company_name: props.vendor?.company_name || '',
  contact_email: props.vendor?.contact_email || '',
  phone: props.vendor?.phone || '',
  user_id: props.vendor?.user_id || '',
});

const validatePhoneNumber = () => {

  form.phone = form.phone.replace(/[^\d+]/g, '');


  if (form.phone.startsWith('+251') && form.phone.length > 12) {
    form.phone = form.phone.slice(0, 12);
  }
  // If starts with 0, ensure it's exactly 10 characters
  else if (form.phone.startsWith('0') && form.phone.length > 10) {
    form.phone = form.phone.slice(0, 10);
  }
};

function submit() {
form.clearErrors();
 if (form.phone) {
  if (form.phone.startsWith('0')) {
    if (form.phone.length !== 10) {
      form.setError('phone', 'Phone must be 10 digits.');
      return;
    }
  } else if (form.phone.startsWith('+251')) {
    if (form.phone.length !== 13) { // +251 + 9 digits = 13 characters
      form.setError('phone', 'Invalid number!');
      return;
    }
  } else {
    form.setError('phone', 'Phone must start with 0 or +251.');
    return;
  }
}

  // Email validation: must end with @gmail.com
  if (form.contact_email) {
    if (!form.contact_email.endsWith('@gmail.com')) {
      form.setError('contact_email', 'Email must end with @gmail.com.');
      return;
    }
  }

  form.put(route('vendor.update', props.vendor.id), {
    onSuccess: () => {
      successMessage.value = 'Vendor updated successfully!';
    //   setTimeout(() => {
    //     successMessage.value = '';
    //   }, 3000);

      router.visit(route('vendor.show', props.vendor.id));
    },
    onError: () => {
      successMessage.value = '';
    }
  });
}
</script>
