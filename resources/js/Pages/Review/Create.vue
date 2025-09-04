<template>
  <div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
          <h1 class="text-2xl font-bold text-white">Create Review</h1>
        </div>
        <div class="p-6">
          <!-- <div v-if="$page.props.errors.error" class="p-4 mb-4 text-red-800 rounded-lg bg-red-50">
            {{ $page.props.error }}
          </div> -->
          <form @submit.prevent="submit" class="space-y-6">
            <div>
              <label class="block mb-2 font-semibold text-gray-700">User *</label>
              <select v-model="form.user_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Select User</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
              </select>
              <span v-if="form.errors.user_id" class="mt-1 text-sm text-red-500">{{ form.errors.user_id }}</span>
            </div>
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Vendor *</label>
              <select v-model="form.vendor_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Select Vendor</option>
                <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.company_name }}</option>
              </select>
              <span v-if="form.errors.vendor_id" class="mt-1 text-sm text-red-500">{{ form.errors.vendor_id }}</span>
            </div>
            <!-- <div>
              <label class="block mb-2 font-semibold text-gray-700">Event *</label>
              <select v-model="form.event_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Select Event</option>
                <option v-for="event in events" :key="event.id" :value="event.id">{{ event.title }}</option>
              </select>
              <span v-if="form.errors.event_id" class="mt-1 text-sm text-red-500">{{ form.errors.event_id }}</span>
            </div> -->
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Rating *</label>
              <select v-model="form.rating" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Select Rating</option>
                <option v-for="rating in [1, 2, 3, 4, 5]" :key="rating" :value="rating">{{ rating }} / 5</option>
              </select>
              <span v-if="form.errors.rating" class="mt-1 text-sm text-red-500">{{ form.errors.rating }}</span>
            </div>
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Comment</label>
              <textarea v-model="form.comment" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
              <span v-if="form.errors.comment" class="mt-1 text-sm text-red-500">{{ form.errors.comment }}</span>
            </div>
            <div class="flex space-x-4">
              <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600" :disabled="form.processing">
                {{ form.processing ? 'Creating...' : 'Create Review' }}
              </button>
              <Link :href="route('review.index')" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Cancel</Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
const props = defineProps(['users', 'vendors', /* 'events' */]);

const form = useForm({
  user_id: '',
  vendor_id: '',
//   event_id: '',
  rating: '',
  comment: '',
});

function submit() {
  form.post(route('review.store'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => router.visit(route('review.index')),
    onError: (errors) => console.error('Form errors:', errors),
  });
}
</script>

