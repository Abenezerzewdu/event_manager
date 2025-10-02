<template>
    <AppHeader />
    <div class="max-w-2xl p-6 mx-auto mt-6 bg-white rounded shadow">
        <h1 class="mb-4 text-2xl font-bold">{{ event.title }}</h1>

        <div class="space-y-3">
            <p>
                <strong>Description:</strong> {{ event.description || "N/A" }}
            </p>
            <p>
                <strong>Date:</strong>
                {{ new Date(event.event_date).toLocaleDateString() }}
            </p>
            <p><strong>Location:</strong> {{ event.location }}</p>
            <p><strong>Budget:</strong> ${{ event.budget }}</p>
            <p>
                <strong>Status:</strong>
                {{ event.is_planned ? "Planned" : "Completed" }}
            </p>
            <p><strong>Organizer:</strong> {{ event.user?.name }}</p>
            <p><strong>Event Type:</strong> {{ event.eventType?.name }}</p>
            <p>
                <strong>Created At:</strong>
                {{ new Date(event.created_at).toLocaleDateString() }}
            </p>
        </div>

        <div class="mt-6 space-x-2">
            <Link
                :href="route('event.edit', event.id)"
                class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600"
            >
                Edit
            </Link>

            <Link
                :href="route('event.index')"
                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
            >
                Back to List
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import AppHeader from "@/Components/AppHeader.vue";
defineProps({
    event: Object,
});
</script>
