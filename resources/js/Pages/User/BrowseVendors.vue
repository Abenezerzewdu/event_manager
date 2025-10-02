<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import VendorServiceCard from "@/Components/VendorServiceCard.vue";

const props = defineProps({
    vendors: Object, // paginated
});

const placeOrder = (vendor) => {
    router.post("/orders", {
        vendor_id: vendor.id,
        service_id: vendor.services[0]?.id, // pick first for now
        event_id: 1,
    });
};
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <VendorServiceCard
            v-for="vendor in vendors"
            :key="vendor.id"
            :vendor="vendor"
            @order="placeOrder"
        />
    </div>

    <!-- Pagination -->
    <!-- <div class="mt-6 flex justify-center" v-if="vendors.links.length > 3">
        <button
            v-for="link in vendors.links"
            :key="link.label"
            v-html="link.label"
            @click="router.get(link.url)"
            :disabled="!link.url"
            class="px-3 py-1 rounded"
            :class="
                link.active
                    ? 'bg-pink-500 text-white'
                    : 'bg-gray-100 text-gray-700'
            "
        />
    </div> -->
</template>
