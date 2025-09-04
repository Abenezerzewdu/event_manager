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
                <h1 class="text-2xl font-bold text-white">Create New Vendor Service</h1>
                <p class="text-blue-100">Assign a service to a vendor</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="p-6">
          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <!-- Vendor -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
                  Vendor *
                </label>
                <select
                  v-model="form.vendor_id"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                >
                  <option value="">Select Vendor</option>
                  <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">
                    {{ vendor.company_name }}
                  </option>
                </select>
                <span v-if="form.errors.vendor_id" class="mt-1 text-sm text-red-500">{{ form.errors.vendor_id }}</span>
              </div>

              <!-- Service -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                  </svg>
                  Service *
                </label>
                <select
                  v-model="form.service_id"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                >
                  <option value="">Select Service</option>
                  <option v-for="service in services" :key="service.id" :value="service.id">
                    {{ service.name }}
                  </option>
                </select>
                <span v-if="form.errors.service_id" class="mt-1 text-sm text-red-500">{{ form.errors.service_id }}</span>
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
                {{ form.processing ? 'Creating Vendor Service...' : 'Create Vendor Service' }}
              </button>

              <Link
                :href="route('vendor-service.index')"
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
  vendors: Array,
  services: Array,
});

const form = useForm({
  vendor_id: '',
  service_id: '',
});

function submit() {
  form.post(route('vendor-service.store'), {
    onSuccess: () => {
      form.reset();
      router.visit(route('vendor-service.index'));
    },
  });
}
</script>

