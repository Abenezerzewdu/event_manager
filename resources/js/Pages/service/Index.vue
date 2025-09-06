```vue
<template>
  <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl">
          <i class="text-2xl text-white fa-solid fa-list"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Our Services</h1>
        <p class="mt-2 text-gray-600">Browse our complete catalog of services</p>

        <!-- Add New Service Button -->
        <button
          @click="openAddModal()"
          class="inline-flex items-center px-4 py-2 mt-6 text-white transition-all rounded-lg bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
        >
          <i class="mr-2 fa-solid fa-plus"></i>
          Add New Service
        </button>
      </div>

      <!-- Stats Summary -->
      <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-4">
        <div class="p-4 bg-white rounded-lg shadow">
          <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
              <i class="text-blue-600 fa-solid fa-gear"></i>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Total Services</p>
              <p class="text-2xl font-bold text-gray-900">{{ services.length }}</p>
            </div>
          </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
          <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
              <i class="text-green-600 fa-solid fa-check-circle"></i>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Active Services</p>
              <p class="text-2xl font-bold text-gray-900">{{ activeServicesCount }}</p>
            </div>
          </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
          <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
              <i class="text-purple-600 fa-solid fa-tags"></i>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Categories</p>
              <p class="text-2xl font-bold text-gray-900">{{ categoriesCount }}</p>
            </div>
          </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
          <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
              <i class="text-yellow-600 fa-solid fa-dollar-sign"></i>
            </div>
            <!-- <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Avg. Price</p>
              <p class="text-2xl font-bold text-gray-900">${{ averagePrice.toFixed(2) }}</p>
            </div> -->
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
          <div class="w-full md:w-1/3">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="text-gray-400 fa-solid fa-magnifying-glass"></i>
              </div>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search services..."
                class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
            </div>
          </div>

          <div class="flex flex-wrap justify-center space-x-2">
            <button
              v-for="category in availableCategories"
              :key="category"
              @click="toggleCategory(category)"
              class="px-3 py-1 mb-2 text-sm font-medium transition-colors rounded-full"
              :class="{
                'bg-indigo-100 text-indigo-800': selectedCategories.includes(category),
                'bg-gray-100 text-gray-800': !selectedCategories.includes(category)
              }"
            >
              {{ category }}
            </button>
          </div>
        </div>
      </div>

      <!-- Services Grid -->
      <div v-if="filteredServices.length > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="service in filteredServices"
          :key="service.id"
          class="overflow-hidden transition-all duration-300 bg-white rounded-lg shadow service-card hover:shadow-lg"
        >
          <div class="p-6">
            <!-- Service Header -->
            <div class="flex items-start justify-between mb-4">
              <div>
                <h3 class="text-xl font-bold text-gray-900">{{ service.name }}</h3>
                <span class="inline-block px-2 py-1 mt-1 text-xs font-medium text-indigo-800 bg-indigo-100 rounded-full">
                  {{ service.category }}
                </span>
              </div>
              <!-- <div class="text-2xl font-bold text-blue-600">${{ service.price.toFixed(2) }}</div> -->
            </div>

            <!-- Service Description -->
            <p class="mb-4 text-gray-600 line-clamp-3">{{ service.description }}</p>

            <!-- Service Meta -->
            <div class="flex items-center justify-between pt-4 mt-4 text-sm text-gray-500 border-t border-gray-200">
              <div class="flex items-center">
                <i class="mr-1 text-gray-400 fa-solid fa-calendar"></i>
                <span>{{ formatDate(service.created_at) }}</span>
              </div>
              <span class="flex items-center" :class="service.status === 'active' ? 'text-green-600' : 'text-red-600'">
                <i class="mr-1 fa-solid fa-circle"></i>
                {{ service.status }}
              </span>
            </div>

            <!-- Action Buttons -->
            <div class="flex mt-6 space-x-2">
              <button
                @click="viewService(service.id)"
                class="flex-1 px-4 py-2 text-center text-white transition-colors bg-blue-500 rounded-lg hover:bg-blue-600"
              >
                <i class="mr-1 fa-solid fa-eye"></i> View
              </button>
              <button
                @click="openEditModal(service)"
                class="flex-1 px-4 py-2 text-center text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200"
              >
                <i class="mr-1 fa-solid fa-pen"></i> Edit
              </button>
              <button
                @click="deleteService(service.id)"
                class="flex-1 px-4 py-2 text-center text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600"
              >
                <i class="mr-1 fa-solid fa-trash"></i> Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="p-8 text-center bg-white rounded-lg shadow">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gray-100 rounded-full">
          <i class="text-gray-400 fa-solid fa-inbox"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">No services found</h3>
        <p class="mt-2 text-gray-600">Try adjusting your search or filter to find what you're looking for.</p>
        <button
          @click="openAddModal()"
          class="inline-flex items-center px-4 py-2 mt-4 text-white transition-all rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700"
        >
          <i class="mr-2 fa-solid fa-plus"></i>
          Add New Service
        </button>
      </div>

      <!-- Pagination (if needed) -->
      <div v-if="services.length > 9" class="flex justify-center mt-8">
        <div class="flex space-x-2">
          <button class="px-3 py-1 text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button class="px-3 py-1 text-white bg-blue-500 border border-blue-500 rounded-lg">1</button>
          <button class="px-3 py-1 text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
          <button class="px-3 py-1 text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
          <button class="px-3 py-1 text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Add Service Modal -->
    <div v-if="showAddModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75" @click="closeModal"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl sm:align-middle sm:max-w-lg">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Add New Service</h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-500">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>

          <form @submit.prevent="addNewService">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Service Name</label>
                <input
                  v-model="newService.name"
                  type="text"
                  required
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Enter service name"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                  v-model="newService.description"
                  required
                  rows="3"
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Describe the service"
                ></textarea>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                  <input
                    v-model.number="newService.price"
                    type="number"
                    step="0.01"
                    min="0"
                    required
                    class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="0.00"
                  >
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700">Category</label>
                  <select
                    v-model="newService.category"
                    required
                    class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
                    <option value="">Select Category</option>
                    <option value="planned">Planned</option>
                    <option value="unplanned">Unplanned</option>
                  </select>
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select
                  v-model="newService.status"
                  required
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
              >
                Add Service
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Edit Service Modal -->
    <div v-if="showEditModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75" @click="closeModal"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl sm:align-middle sm:max-w-lg">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Service</h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-500">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>

          <form @submit.prevent="updateService">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Service Name</label>
                <input
                  v-model="editService.name"
                  type="text"
                  required
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Enter service name"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                  v-model="editService.description"
                  required
                  rows="3"
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Describe the service"
                ></textarea>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                  <input
                    v-model.number="editService.price"
                    type="number"
                    step="0.01"
                    min="0"
                    required
                    class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="0.00"
                  >
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700">Category</label>
                  <select
                    v-model="editService.category"
                    required
                    class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
                    <option value="">Select Category</option>
                    <option value="planned">Planned</option>
                    <option value="unplanned">Unplanned</option>
                  </select>
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select
                  v-model="editService.status"
                  required
                  class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                Update Service
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { ref, computed, reactive, watch } from 'vue';

// Props from server
const props = defineProps({
  services: {
    type: Array,
    default: () => []
  }
});

// State
const services = ref([...props.services]);
const searchQuery = ref('');
const selectedCategories = ref([]);
const showAddModal = ref(false);
const showEditModal = ref(false);
const newService = reactive({
  name: '',
  description: '',
  price: 0,
  category: '',
  status: 'active'
});
const editService = reactive({
  id: null,
  name: '',
  description: '',
  price: 0,
  category: '',
  status: 'active'
});

// Computed properties
const availableCategories = computed(() => {
  return [...new Set(services.value.map(service => service.category || ''))];
});

const activeServicesCount = computed(() => {
  return services.value.filter(service => service.status === 'active').length;
});

const categoriesCount = computed(() => {
  return availableCategories.value.length;
});

const averagePrice = computed(() => {
  if (!services.value || services.value.length === 0) return 0;
  const total = services.value.reduce((sum, service) => {
    return sum + (service.price || 0);
  }, 0);
  return total / services.value.length;
});

const filteredServices = computed(() => {
  let result = services.value;

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(service =>
      (service.name && service.name.toLowerCase().includes(query)) ||
      (service.description && service.description.toLowerCase().includes(query))
    );
  }

  if (selectedCategories.value.length > 0) {
    result = result.filter(service =>
      selectedCategories.value.includes(service.category)
    );
  }

  return result;
});

// Methods
const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
};

const toggleCategory = (category) => {
  const index = selectedCategories.value.indexOf(category);
  if (index === -1) {
    selectedCategories.value.push(category);
  } else {
    selectedCategories.value.splice(index, 1);
  }
};

const deleteService = (id) => {
  if (confirm('Are you sure you want to delete this service?')) {
    router.delete(`/services/${id}`, {
      onSuccess: () => {
        services.value = services.value.filter(service => service.id !== id);
      }
    });
  }
};

const viewService = (id) => {
  router.get(`/services/${id}`);
};

const openAddModal = () => {
  Object.assign(newService, {
    name: '',
    description: '',
    price: 0,
    category: '',
    status: 'active'
  });
  showAddModal.value = true;
};

const openEditModal = (service) => {
  Object.assign(editService, {
    id: service.id,
    name: service.name,
    description: service.description,
    price: service.price,
    category: service.category,
    status: service.status
  });
  showEditModal.value = true;
};

const closeModal = () => {
  showAddModal.value = false;
  showEditModal.value = false;
};

const addNewService = () => {
  router.post('/services', {
    ...newService,
    price: parseFloat(newService.price)
  }, {
    onSuccess: (page) => {
      services.value = [...page.props.services];
      closeModal();
      alert('Service added successfully!');
    },
    onError: (errors) => {
      alert('Validation failed: ' + Object.values(errors).join(', '));
    }
  });
};

const updateService = () => {
  router.put(`/services/${editService.id}`, {
    ...editService,
    price: parseFloat(editService.price)
  }, {
    onSuccess: (page) => {
      services.value = [...page.props.services];
      closeModal();
      alert('Service updated successfully!');
    },
    onError: (errors) => {
      alert('Validation failed: ' + Object.values(errors).join(', '));
    }
  });
};

// Watch for prop changes
watch(() => props.services, (newServices) => {
  services.value = [...newServices];
}, { immediate: true });
</script>

