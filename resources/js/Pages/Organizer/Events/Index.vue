<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";
defineProps({
    events: Array,
});

const showModal = ref(false);
const selectedEvent = ref(null);

const form = useForm({});

// Open modal
const confirmDelete = (event) => {
    selectedEvent.value = event;
    showModal.value = true;
};

// Perform delete
const deleteEvent = () => {
    if (selectedEvent.value) {
        form.delete(route("organizer.events.destroy", selectedEvent.value.id), {
            onFinish: () => {
                showModal.value = false;
                selectedEvent.value = null;
            },
        });
    }
};
</script>

<template>
    <OrganizerLayout>
        <div class="max-w-6xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">My Events</h1>

            <div class="flex justify-end mb-4">
                <Link
                    :href="route('event.create')"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    + Create Event
                </Link>
            </div>

            <!-- Empty state -->
            <div
                v-if="events.length === 0"
                class="text-center py-10 bg-white shadow rounded"
            >
                <p class="text-gray-500">You haven’t created any events yet.</p>
            </div>

            <!-- Events table -->
            <div v-else class="overflow-x-auto bg-white shadow rounded">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">Title</th>
                            <th class="px-4 py-2 border-b">Date</th>
                            <th class="px-4 py-2 border-b">Location</th>
                            <th class="px-4 py-2 border-b">Budget</th>
                            <th class="px-4 py-2 border-b">Status</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="event in events"
                            :key="event.id"
                            class="hover:bg-gray-50"
                        >
                            <td class="px-4 py-2 border-b font-medium">
                                {{ event.title }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                {{
                                    new Date(
                                        event.event_date
                                    ).toLocaleDateString()
                                }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                {{ event.location }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                ${{ event.budget }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                <span
                                    :class="
                                        event.is_planned
                                            ? 'text-green-600'
                                            : 'text-gray-500'
                                    "
                                >
                                    {{
                                        event.is_planned
                                            ? "Planned"
                                            : "Completed"
                                    }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <Link
                                    :href="
                                        route('organizer.events.show', event.id)
                                    "
                                    class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600"
                                >
                                    View
                                </Link>
                                <Link
                                    :href="
                                        route('organizer.events.edit', event.id)
                                    "
                                    class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="confirmDelete(event)"
                                    class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Delete Confirmation Modal -->
            <div
                v-if="showModal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            >
                <div class="bg-white p-6 rounded shadow-lg w-96">
                    <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
                    <p class="mb-6">
                        Are you sure you want to delete
                        <strong>{{ selectedEvent?.title }}</strong
                        >?
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button
                            @click="showModal = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                        >
                            Cancel
                        </button>
                        <button
                            @click="deleteEvent"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </OrganizerLayout>
</template>
