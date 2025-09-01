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
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
              </div>
              <div>
                <h1 class="text-2xl font-bold text-white">Create New Vendor</h1>
                <p class="text-blue-100">Fill in the details to create a new vendor</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="p-6">
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
                  class="w-full px-4 py-3 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:placeholder-transparent"
                  placeholder="0XXXXXXXXX or +251XXXXXXXXX"
                  required
                  @input="validatePhoneNumber"

                />
                <span v-if="form.errors.phone" class="mt-1 text-sm text-red-500">{{ form.errors.phone }}</span>
                <!-- <p class="mt-1 text-xs text-gray-500"> start with 0 or +251 </p> -->
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

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <!-- Status -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                  </svg>
                  Status *
                </label>
                <select
                  v-model="form.status"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                >
                  <option value="pending">Pending</option>
                  <option value="approved">Approved</option>
                  <option value="rejected">Rejected</option>
                </select>
                <span v-if="form.errors.status" class="mt-1 text-sm text-red-500">{{ form.errors.status }}</span>
              </div>

              <!-- Vendor File -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                  </svg>
                  Vendor File
                </label>
                <input
                  type="file"
                  @input="form.vendors_file = $event.target.files[0]"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
                <span v-if="form.errors.vendors_file" class="mt-1 text-sm text-red-500">{{ form.errors.vendors_file }}</span>
              </div>
            </div>

            <!-- Description -->
            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                Description
              </label>
              <textarea
                v-model="form.description"
                rows="3"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Describe the vendor..."
              ></textarea>
              <span v-if="form.errors.description" class="mt-1 text-sm text-red-500">{{ form.errors.description }}</span>
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
                {{ form.processing ? 'Creating Vendor...' : 'Create Vendor' }}
              </button>

              <Link
                :href="route('vendor.index')"
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

const props = defineProps({
  users: Array
});

const form = useForm({
  company_name: '',
  contact_email: '',
  phone: '',
  user_id: '',
  status: 'pending',
  description: '',
  vendors_file: null,
});

const validatePhoneNumber = () => {
  // Remove any non-digit characters except +
  form.phone = form.phone.replace(/[^\d+]/g, '');

  // If starts with +251, ensure it's exactly 13 characters
  if (form.phone.startsWith('+251') && form.phone.length > 13) {
    form.phone = form.phone.slice(0, 13);
  }
  // If starts with 0, ensure it's exactly 10 characters
  else if (form.phone.startsWith('0') && form.phone.length > 10) {
    form.phone = form.phone.slice(0, 10);
  }
};

function submit() {

  if (form.phone) {
    const phoneRegex = /^(0|\+251)\d{9}$/;
    if (!phoneRegex.test(form.phone)) {
      form.errors.phone = 'Phone must be 10 digits, start with 0 or +251';
      return;
    }
  }

  // Email validation: must end with @gmail.com
  if (form.contact_email) {
    if (!form.contact_email.endsWith('@gmail.com')) {
      form.errors.contact_email = 'Email must end with @gmail.com.';
      return;
    }
  }

  form.post(route('vendor.store'), {
    onSuccess: () => {
      form.reset();
      router.visit(route('vendor.index'));
    },
  });
}
</script>
