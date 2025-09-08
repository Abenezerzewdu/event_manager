```vue
<template>
    <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Edit Service
                    </h1>
                    <button
                        @click="router.get('/services')"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Service Name</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter service name"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Description</label
                        >
                        <textarea
                            v-model="form.description"
                            required
                            rows="3"
                            class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Describe the service"
                        ></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Price ($)</label
                            >
                            <input
                                v-model.number="form.price"
                                type="number"
                                step="0.01"
                                min="0"
                                required
                                class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="0.00"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Category</label
                            >
                            <select
                                v-model="form.category"
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
                        <label class="block text-sm font-medium text-gray-700"
                            >Status</label
                        >
                        <select
                            v-model="form.status"
                            required
                            class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button
                            type="button"
                            @click="router.get('/services')"
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
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ service: Object });

const form = useForm({
    id: props.service.id,
    name: props.service.name,
    description: props.service.description,
    price: props.service.price,
    category: props.service.category,
    status: props.service.status,
});

const submitForm = () => {
    form.put(route("service.update", form.id), {
        onSuccess: () => {
            alert("Service updated successfully!"); // you can use flash message too
        },
    });
};
</script>
