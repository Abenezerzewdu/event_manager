```vue
<template>
    <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Service Details
                    </h1>
                    <button
                        @click="router.get('/services')"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div v-if="service" class="space-y-4">
                    <p><strong>Name:</strong> {{ service.name }}</p>
                    <p>
                        <strong>Description:</strong> {{ service.description }}
                    </p>
                    <p><strong>Price:</strong> ${{ service.price }}</p>
                    <p><strong>Category:</strong> {{ service.category }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span
                            :class="
                                service.status === 'active'
                                    ? 'text-green-600'
                                    : 'text-red-600'
                            "
                            >{{ service.status }}</span
                        >
                    </p>
                    <p>
                        <strong>Created At:</strong>
                        {{ formatDate(service.created_at) }}
                    </p>
                    <button
                        @click="router.get(`/services/${service.id}/edit`)"
                        class="px-4 py-2 text-white transition-colors bg-blue-500 rounded-lg hover:bg-blue-600"
                    >
                        <i class="mr-1 fa-solid fa-pen"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    service: Object,
});

const service = ref(props.service);

watch(
    () => props.service,
    (newService) => {
        service.value = newService;
    },
    { immediate: true }
);

const formatDate = (dateString) => {
    if (!dateString) return "N/A";
    const date = new Date(dateString);
    return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
    });
};
</script>
