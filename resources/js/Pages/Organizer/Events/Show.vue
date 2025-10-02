<script setup>
import { Link } from "@inertiajs/vue3";
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";

defineProps({
    event: Object,
});
</script>

<template>
    <OrganizerLayout>
        <div
            class="max-w-3xl mx-auto mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8"
        >
            <h1
                class="text-3xl font-bold mb-6 text-blue-600 dark:text-blue-400"
            >
                {{ event.title }}
            </h1>

            <div class="space-y-4 text-gray-700 dark:text-gray-200">
                <p>
                    <span class="font-semibold">Description:</span>
                    {{ event.description || "N/A" }}
                </p>

                <p>
                    <span class="font-semibold">Date:</span>
                    {{ new Date(event.event_date).toLocaleDateString() }}
                </p>

                <p>
                    <span class="font-semibold">Location:</span>
                    {{ event.location }}
                </p>

                <p>
                    <span class="font-semibold">Budget:</span>
                    ${{ event.budget }}
                </p>

                <p>
                    <span class="font-semibold">Status:</span>
                    <span
                        :class="
                            event.is_planned
                                ? 'text-green-500 font-semibold'
                                : 'text-red-500 font-semibold'
                        "
                    >
                        {{ event.is_planned ? "Planned" : "Completed" }}
                    </span>
                </p>

                <p>
                    <span class="font-semibold">Event Type:</span>
                    {{ event.eventType?.name }}
                </p>

                <p>
                    <span class="font-semibold">Created At:</span>
                    {{ new Date(event.created_at).toLocaleDateString() }}
                </p>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex gap-3">
                <Link
                    :href="route('organizer.events.edit', event.id)"
                    class="px-5 py-2 rounded-lg bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition"
                >
                    Edit
                </Link>

                <Link
                    :href="route('organizer.events.index')"
                    class="px-5 py-2 rounded-lg bg-blue-500 text-white font-semibold hover:bg-blue-600 transition"
                >
                    Back to My Events
                </Link>
            </div>
        </div>
    </OrganizerLayout>
</template>
