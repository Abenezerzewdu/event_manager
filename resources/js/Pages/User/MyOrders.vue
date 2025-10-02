<template>
    <OrganizerLayout>
        <div class="p-6">
            <!-- Page Title -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h1>

            <!-- Flash Success -->
            <div
                v-if="$page.props.flash.success"
                class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Orders List -->
            <div
                v-if="orders.length > 0"
                class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    v-for="order in orders"
                    :key="order.id"
                    class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6 flex flex-col justify-between"
                >
                    <!-- Vendor Info -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Vendor: {{ order.vendor.company_name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ order.vendor.address }}
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
                    <div class="flex items-center justify-between mt-4">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold"
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

                        <PrimaryButton @click="viewDetails(order)">
                            View
                        </PrimaryButton>
                    </div>
                </div>
            </div>

            <!-- No Orders -->
            <div v-else class="text-center py-12 text-gray-500">
                You haven’t placed any orders yet.
            </div>
        </div>
    </OrganizerLayout>
</template>

<script setup>
import { defineProps } from "vue";
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    orders: Array,
});

function viewDetails(order) {
    alert(
        `Order #${order.id}\nVendor: ${order.vendor.company_name}\nService: ${order.service.name}\nEvent: ${order.event.title}\nStatus: ${order.status}`
    );
}
</script>
