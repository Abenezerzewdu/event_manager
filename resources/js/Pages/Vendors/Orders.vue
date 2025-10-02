<template>
    <VendorLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Orders</h1>

            <!-- Flash -->
            <div
                v-if="$page.props.flash.success"
                class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm"
            >
                {{ $page.props.flash.success }}
            </div>

            <div
                v-if="orders.length > 0"
                class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    v-for="order in orders"
                    :key="order.id"
                    class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6 flex flex-col justify-between"
                >
                    <!-- User Info -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Ordered by: {{ order.user.name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ order.user.email }}
                        </p>
                    </div>

                    <!-- Event Info -->
                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-gray-700">
                            Event: {{ order.event.title }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            Date: {{ order.event.event_date }}
                        </p>
                    </div>

                    <!-- Service Info -->
                    <div class="mb-4">
                        <h4 class="text-md font-semibold text-gray-700">
                            Service: {{ order.service.name }}
                        </h4>
                        <p class="text-sm text-gray-600">
                            {{ order.service.description }}
                        </p>
                    </div>

                    <!-- Status + Actions -->
                    <div class="flex flex-col gap-2 mt-4">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold self-start"
                            :class="{
                                'bg-yellow-100 text-yellow-700':
                                    order.status === 'pending',
                                'bg-blue-100 text-blue-700':
                                    order.status === 'confirmed',
                                'bg-green-100 text-green-700':
                                    order.status === 'completed',
                                'bg-red-100 text-red-700':
                                    order.status === 'cancelled',
                            }"
                        >
                            {{ order.status }}
                        </span>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mt-2">
                            <button
                                v-for="status in statuses"
                                :key="status.value"
                                @click="openModal(order, status.value)"
                                class="px-3 py-1 text-xs rounded-md font-medium"
                                :class="status.class"
                            >
                                {{ status.label }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-12 text-gray-500">
                No orders yet.
            </div>

            <!-- Confirmation Modal -->
            <ConfirmModal
                :show="showModal"
                :title="modalTitle"
                :message="modalMessage"
                @close="closeModal"
                @confirm="submitStatus"
            />
        </div>
    </VendorLayout>
</template>

<script setup>
import VendorLayout from "@/Layouts/VendorLayout.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
const props = defineProps({
    orders: Array,
});

const statuses = [
    {
        value: "confirmed",
        label: "Confirm",
        class: "bg-blue-500 text-white hover:bg-blue-600",
    },
    {
        value: "completed",
        label: "Complete",
        class: "bg-green-500 text-white hover:bg-green-600",
    },
    {
        value: "cancelled",
        label: "Cancel",
        class: "bg-red-500 text-white hover:bg-red-600",
    },
];

// Modal state
const showModal = ref(false);
const selectedOrder = ref(null);
const selectedStatus = ref(null);
const modalTitle = ref("");
const modalMessage = ref("");

// Open modal
const openModal = (order, status) => {
    selectedOrder.value = order;
    selectedStatus.value = status;
    modalTitle.value = `Confirm ${status}?`;
    modalMessage.value = `Are you sure you want to mark this order as "${status}"?`;
    showModal.value = true;
};

// Close modal
const closeModal = () => {
    showModal.value = false;
    selectedOrder.value = null;
    selectedStatus.value = null;
};

// Submit status update
const submitStatus = () => {
    if (selectedOrder.value && selectedStatus.value) {
        router.put(
            route("vendor.orders.updateStatus", selectedOrder.value.id),
            {
                status: selectedStatus.value,
            }
        );
    }
    closeModal();
};
</script>
