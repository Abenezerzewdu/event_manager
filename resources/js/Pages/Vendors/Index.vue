<template>
  <div class="min-h-screen p-6 bg-gray-50">
    <!-- Navigation -->
    <nav class="mb-6 text-white bg-blue-800 shadow-lg">
      <div class="container flex items-center justify-between px-6 py-3 mx-auto">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <span class="text-xl font-semibold tracking-tight">Vendor Manager</span>
        </div>
        <div class="flex space-x-4">
          <Link :href="route('vendor.create')" class="px-3 py-2 text-sm font-medium rounded-md hover:bg-blue-700">Create Vendor</Link>
        </div>
      </div>
    </nav>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ vendors.length }}</h3>
            <p class="text-gray-600">Total Vendors</p>
          </div>
        </div>
      </div>
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
  </svg>
</div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ approvedVendorsCount }}</h3>
            <p class="text-gray-600">Approved</p>
          </div>
        </div>
      </div>
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-yellow-600 bg-yellow-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ pendingVendorsCount }}</h3>
            <p class="text-gray-600">Pending</p>
          </div>
        </div>
      </div>
      <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
          <div class="p-3 mr-4 text-purple-600 bg-purple-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ vendorsWithPhoneCount }}</h3>
            <p class="text-gray-600">With Contact Info</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendors Table -->
    <div class="overflow-hidden bg-white rounded-lg shadow">
      <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
        <h2 class="text-xl font-semibold text-blue-800">All Vendors</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Vendor</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Contact Info</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">User Account</th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="vendor in vendors" :key="vendor.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ vendor.company_name }}</div>
                    <div class="text-sm text-gray-500">Created: {{ formatDate(vendor.created_at) }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ vendor.contact_email }}</div>
                <div class="text-sm text-gray-500">{{ vendor.phone }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="`inline-flex px-2 py-1 text-xs font-semibold leading-5 rounded-full ${getStatusColor(vendor.status)}`">
                  {{ vendor.status }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ vendor.user ? vendor.user.name : 'N/A' }}</div>
                <div class="text-sm text-gray-500">ID: {{ vendor.user_id }}</div>
              </td>
              <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                <div class="flex space-x-2">
                  <Link :href="route('vendor.show', vendor.id)" class="p-1 text-blue-600 rounded-full hover:text-blue-900 hover:bg-blue-100" title="View">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </Link>
                  <Link :href="route('vendor.edit', vendor.id)" class="p-1 text-indigo-600 rounded-full hover:text-indigo-900 hover:bg-indigo-100" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </Link>
                  <button @click="deleteVendor(vendor.id)" class="p-1 text-red-600 rounded-full hover:text-red-900 hover:bg-red-100" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  vendors: {
    type: Array,
    default: () => []
  }
});

const approvedVendorsCount = computed(() => {
  return props.vendors.filter(vendor => vendor.status === 'approved').length;
});

const pendingVendorsCount = computed(() => {
  return props.vendors.filter(vendor => vendor.status === 'pending').length;
});

const vendorsWithPhoneCount = computed(() => {
  return props.vendors.filter(vendor => vendor.phone && vendor.phone.trim() !== '').length;
});

const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  if (isNaN(date.getTime())) return 'Invalid date';
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return date.toLocaleDateString(undefined, options);
};

const getStatusColor = (status) => {
  const colors = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'approved': 'bg-green-100 text-green-800',
    'rejected': 'bg-red-100 text-red-800'
  };
  return colors[status] || 'bg-gray-100 text-gray-800';
};

const deleteVendor = (vendorId) => {
  if (!confirm('Are you sure you want to delete this vendor?')) return;

  router.delete(route('vendor.destroy', vendorId), {
    onSuccess: () => {
      // Remove vendor from reactive list immediately
      vendorsList.value = vendorsList.value.filter(v => v.id !== vendorId);
    },
    onError: (errors) => {
      alert('Error deleting vendor: ' + (errors.message || 'Unknown error'));
    }
  });
};
</script>
