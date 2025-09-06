<template>

  <div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
      <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
          <h1 class="text-2xl font-bold text-white">Reviews</h1>
        </div>
        <div class="p-6">
          <!-- <div v-if="$page.props.flash.success" class="p-4 mb-4 text-green-800 rounded-lg bg-green-50">
            {{ $page.props.flash.success }}
          </div> -->
          <div class="grid gap-4">
            <div v-for="review in reviews" :key="review.id" class="p-4 border rounded-lg">
              <p><strong>User:</strong> {{ review.user?.name || 'Unknown' }}</p>
              <p><strong>Vendor:</strong> {{ review.vendor?.company_name || 'Unknown' }}</p>
              <!-- <p><strong>Event:</strong> {{ review.event?.title || 'Unknown' }}</p> -->

              <p><strong>Rating:</strong><span v-for="star in 5" :key="star" class="text-yellow-400">
                {{ star <= review.rating ? '★' : '☆' }}
              </span></p>
              <p><strong>Comment:</strong> {{ review.comment || 'N/A' }}</p>
            </div>
          </div>
          <div class="mt-6">
            <Link v-if="isAuthenticated" :href="route('review.create')" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Add Review</Link>
            <p v-else class="text-red-500">Please log in to add a review.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps(['reviews']);
const isAuthenticated = computed(() => !!window.Laravel?.user);
</script>

