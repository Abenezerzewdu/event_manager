<template>
    <VendorLayout title="Dashboard">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Users Card -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-r from-blue-400 to-blue-600 text-white flex flex-col justify-between"
            >
                <div>
                    <h2 class="text-xl font-semibold">Users</h2>
                    <p class="text-3xl font-bold mt-2">
                        {{ stats.users ?? 0 }}
                    </p>
                </div>
                <div class="mt-4">
                    <span class="text-sm opacity-80"
                        >Total registered users</span
                    >
                </div>
            </div>

            <!-- Orders Card -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-r from-green-400 to-green-600 text-white flex flex-col justify-between"
            >
                <div>
                    <h2 class="text-xl font-semibold">Orders</h2>
                    <p class="text-3xl font-bold mt-2">
                        {{ stats.orders ?? 0 }}
                    </p>
                </div>
                <div class="mt-4">
                    <span class="text-sm opacity-80">Total orders placed</span>
                </div>
            </div>

            <!-- Services Card -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-r from-purple-400 to-purple-600 text-white flex flex-col justify-between"
            >
                <div>
                    <h2 class="text-xl font-semibold">Services</h2>
                    <p class="text-3xl font-bold mt-2">
                        {{ stats.services ?? 0 }}
                    </p>
                </div>
                <div class="mt-4">
                    <span class="text-sm opacity-80"
                        >Active services offered</span
                    >
                </div>
            </div>
        </div>
    </VendorLayout>
</template>

<script setup>
import VendorLayout from "@/Layouts/VendorLayout.vue";

defineProps({
    stats: {
        type: Object,
        default: () => ({ users: 0, orders: 0, services: 0 }),
    },
});
</script>

<style>
/* Optional: add subtle hover effect on cards */
div > .rounded-xl:hover {
    transform: translateY(-4px);
    transition: transform 0.2s ease-in-out;
}
</style>
