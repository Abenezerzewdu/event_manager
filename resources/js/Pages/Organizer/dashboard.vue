<script setup>
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";

defineProps({
    stats: Object, // { events: number, orders: number, vendors: number }
});
</script>

<template>
    <OrganizerLayout>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition"
            >
                <h3 class="text-lg font-semibold">My Events</h3>
                <p class="text-3xl font-bold text-blue-600">
                    {{ stats.events }}
                </p>
            </div>

            <div
                class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition"
            >
                <h3 class="text-lg font-semibold">My Orders</h3>
                <p class="text-3xl font-bold text-yellow-500">
                    {{ stats.orders }}
                </p>
            </div>

            <div
                class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition"
            >
                <h3 class="text-lg font-semibold">Vendors Ordered</h3>
                <p class="text-3xl font-bold text-purple-500">
                    {{ stats.vendors }}
                </p>
            </div>
        </div>
    </OrganizerLayout>
</template>
