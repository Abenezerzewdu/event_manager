<template>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Select Event for this Order</h2>

        <form @submit.prevent="submitOrder">
            <label class="block mb-2 text-gray-700">Choose Event</label>
            <select v-model="eventId" class="w-full border rounded p-2 mb-4">
                <option
                    v-for="event in events"
                    :key="event.id"
                    :value="event.id"
                >
                    {{ event.name }} ({{ event.date }})
                </option>
            </select>

            <button
                type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded shadow"
            >
                Confirm Order
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    events: Array,
    vendor_id: Number,
    service_id: Number,
});

const eventId = ref(props.events.length ? props.events[0].id : null);

const submitOrder = () => {
    router.post(route("orders.store"), {
        vendor_id: props.vendor_id,
        service_id: props.service_id,
        event_id: eventId.value,
    });
};
</script>
