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
                <h1 class="text-2xl font-bold text-white">Create New Guest</h1>
                <p class="text-blue-100">Add a guest to an event</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="p-6">
          <!-- Error message display -->
          <!-- <div v-if="$page.props.errors.error" class="p-4 mb-4 text-red-800 rounded-lg bg-red-50">
            {{ $page.props.errors.error }}
          </div> -->

          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <!-- Name -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  Name *
                </label>
                <input
                  v-model="form.name"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                />
                <span v-if="form.errors.name" class="mt-1 text-sm text-red-500">{{ form.errors.name }}</span>
              </div>

              <!-- Email -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Email
                </label>
                <input
                  v-model="form.email"
                  type="email"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  @input="validateEmail"
                  placeholder="e.g., john123@gmail.com"
                />
                <span v-if="emailError" class="mt-1 text-sm text-red-500">{{ emailError }}</span>
                <span v-if="form.errors.email" class="mt-1 text-sm text-red-500">{{ form.errors.email }}</span>
              </div>

              <!-- Phone -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  Phone *
                </label>
                <input
                  v-model="form.phone"
                  type="tel"
                  pattern="[0-9]*"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                  @input="handleInput"
                  :placeholder="phonePlaceholder"
                />
                <span v-if="phoneError" class="mt-1 text-sm text-red-500">{{ phoneError }}</span>
                <span v-if="form.errors.phone" class="mt-1 text-sm text-red-500">{{ form.errors.phone }}</span>
              </div>

              <!-- Event -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Event *
                </label>
                <select
                  v-model="form.event_id"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                >
                  <option value="">Select Event</option>
                  <option v-for="event in events" :key="event.id" :value="event.id">
                    {{ event.title }}
                  </option>
                </select>
                <span v-if="form.errors.event_id" class="mt-1 text-sm text-red-500">{{ form.errors.event_id }}</span>
              </div>

              <!-- Is Attending -->
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  Attending
                </label>
                <input
                  v-model="form.is_attending"
                  type="checkbox"
                  class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                />
                <span v-if="form.errors.is_attending" class="mt-1 text-sm text-red-500">{{ form.errors.is_attending }}</span>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex pt-6 space-x-4 border-t">
              <button
                type="submit"
                class="flex items-center px-6 py-3 text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
                :disabled="form.processing || phoneError || emailError"
              >
                <svg v-if="form.processing" class="w-4 h-4 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ form.processing ? 'Creating Guest...' : 'Create Guest' }}
              </button>

              <Link
                :href="route('guest.index')"
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
import { ref, watch } from 'vue';

const props = defineProps({
  events: Array,
  errors: Object, // Make sure this is passed from controller
});

const form = useForm({
  name: '',
  email: '',
  phone: '',
  event_id: '',
  is_attending: false,
});

const phoneError = ref('');
const emailError = ref('');
const phonePlaceholder = ref('e.g., 09XXXXXXXX or +2519XXXXXXXX');

// Add this to watch for server errors
watch(() => props.errors, (newErrors) => {
  if (newErrors.phone) {
    phoneError.value = newErrors.phone;
  }
  if (newErrors.email) {
    emailError.value = newErrors.email;
  }
});

const validatePhone = () => {
  const phoneValue = form.phone || '';
  phoneError.value = ''; // Clear previous errors

  if (phoneValue.startsWith('09')) {
    if (phoneValue.length !== 10) {
      phoneError.value = 'Phone must be exactly 10 digits';
    } else if (!/^[0-9]{10}$/.test(phoneValue)) {
      phoneError.value = 'Phone must contain only numbers';
    }
  } else if (phoneValue.startsWith('+251')) {
    if (phoneValue.length !== 13) {
      phoneError.value = 'Phone must be exactly 13 digits starting with +251';
    } else if (!/^\+251[0-9]{9}$/.test(phoneValue)) {
      phoneError.value = 'Phone must contain only numbers after +251';
    }
  } else if (phoneValue && !/^(0|\+251)/.test(phoneValue)) {
    phoneError.value = 'Phone must start with 0 or +251';
  }
};

const validateEmail = () => {
  const emailRegex = /^[a-zA-Z0-9]+@gmail\.com$/;
  const emailValue = form.email || '';
  if (emailValue && !emailRegex.test(emailValue)) {
    emailError.value = 'Email must end with @gmail.com and contain only letters and numbers (e.g., john123@gmail.com)';
  } else {
    emailError.value = '';
  }
};

const handleInput = (event) => {
  let value = event.target.value.replace(/[^0-9+]/g, '');

  if (value.startsWith('09')) {
    value = value.slice(0, 10);
  } else if (value.startsWith('+251')) {
    value = value.slice(0, 13);
  }

  form.phone = value;
  validatePhone();
  phonePlaceholder.value = form.phone ? '' : 'e.g., 0912345678 or +251912345678';
};

watch(() => form.phone, validatePhone);
watch(() => form.email, validateEmail);

function submit() {
  // Clear previous errors
  phoneError.value = '';
  emailError.value = '';

  // Validate before submission
  validatePhone();
  validateEmail();

  if (phoneError.value || emailError.value) {
    return;
  }

  form.post(route('guest.store'), {
  preserveScroll: true,
  onSuccess: () => {
    form.reset();
    router.visit(route('guest.index'));
  },
  onError: (errors) => {
    console.error('Form submission errors:', errors);
    if (errors.phone) {
      phoneError.value = errors.phone;
    }
    if (errors.email) {
      emailError.value = errors.email;
    }
  },
});
}
</script>

