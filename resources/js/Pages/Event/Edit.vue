<template>
    <div class="min-h-screen py-8 bg-gray-50">
        <div class="max-w-4xl px-4 mx-auto">
            <div class="overflow-hidden bg-white shadow-lg rounded-xl">
                <!-- Header -->
                <div
                    class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 mr-3 bg-white rounded-lg">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-blue-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">
                                    Edit Event
                                </h1>
                                <p class="text-blue-100">
                                    Update the details of the event
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="p-6">
                    <!-- Success message display -->
                    <div
                        v-if="successMessage"
                        class="p-4 mb-4 text-green-800 rounded-lg bg-green-50"
                    >
                        {{ successMessage }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Event Title -->
                            <div>
                                <label
                                    class="block mb-2 font-semibold text-gray-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline w-4 h-4 mr-1 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        />
                                    </svg>
                                    Event Title *
                                </label>
                                <input
                                    v-model="form.title"
                                    type="text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Enter event title"
                                    required
                                />
                                <span
                                    v-if="form.errors.title"
                                    class="mt-1 text-sm text-red-500"
                                    >{{ form.errors.title }}</span
                                >
                            </div>

                            <!-- Event Date -->
                            <div>
                                <label
                                    class="block mb-2 font-semibold text-gray-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline w-4 h-4 mr-1 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                    Event Date *
                                </label>
                                <input
                                    v-model="form.event_date"
                                    type="date"
                                    min="2025-09-01"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                />
                                <span
                                    v-if="form.errors.event_date"
                                    class="mt-1 text-sm text-red-500"
                                    >{{ form.errors.event_date }}</span
                                >
                            </div>

                            <!-- Location -->
                            <div>
                                <label
                                    class="block mb-2 font-semibold text-gray-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline w-4 h-4 mr-1 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                    Location *
                                </label>
                                <input
                                    v-model="form.location"
                                    type="text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Event location"
                                    required
                                />
                                <span
                                    v-if="form.errors.location"
                                    class="mt-1 text-sm text-red-500"
                                    >{{ form.errors.location }}</span
                                >
                            </div>

                            <!-- Budget -->
                            <div>
                                <label
                                    class="block mb-2 font-semibold text-gray-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline w-4 h-4 mr-1 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                    Budget ($) *
                                </label>
                                <input
                                    v-model="form.budget"
                                    type="number"
                                    step="0.01"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="0.00"
                                    required
                                />
                                <span
                                    v-if="form.errors.budget"
                                    class="mt-1 text-sm text-red-500"
                                    >{{ form.errors.budget }}</span
                                >
                            </div>

                            <!-- Event Type -->
                            <div>
                                <label
                                    class="block mb-2 font-semibold text-gray-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline w-4 h-4 mr-1 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                        />
                                    </svg>
                                    Event Type *
                                </label>
                                <select
                                    v-model="form.event_type_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                    <option value="">Select Event Type</option>
                                    <option
                                        v-for="eventType in eventTypes"
                                        :key="eventType.id"
                                        :value="eventType.id"
                                    >
                                        {{ eventType.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="form.errors.event_type_id"
                                    class="mt-1 text-sm text-red-500"
                                    >{{ form.errors.event_type_id }}</span
                                >
                            </div>
                        </div>

                        <!-- Description (Full Width) -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="inline w-4 h-4 mr-1 text-blue-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
                                    />
                                </svg>
                                Description
                            </label>
                            <textarea
                                v-model="form.description"
                                rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Describe the event..."
                            ></textarea>
                            <span
                                v-if="form.errors.description"
                                class="mt-1 text-sm text-red-500"
                                >{{ form.errors.description }}</span
                            >
                        </div>

                        <!-- Status -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                Status *
                            </label>
                            <select
                                v-model="form.is_planned"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                                <option value="1">Planned</option>
                                <option value="0">Completed</option>
                            </select>
                            <span
                                v-if="form.errors.is_planned"
                                class="mt-1 text-sm text-red-500"
                                >{{ form.errors.is_planned }}</span
                            >
                        </div>

                        <!-- Actions -->
                        <div class="flex pt-6 space-x-4 border-t">
                            <button
                                type="submit"
                                class="flex items-center px-6 py-3 text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
                                :disabled="form.processing"
                            >
                                <svg
                                    v-if="form.processing"
                                    class="w-4 h-4 mr-2 -ml-1 text-white animate-spin"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                                {{
                                    form.processing
                                        ? "Updating Event..."
                                        : "Update Event"
                                }}
                            </button>

                            <Link
                                :href="route('event.show', event.id)"
                                class="flex items-center px-6 py-3 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                                Cancel
                            </Link>
                            <Link
                                :href="route('event.index')"
                                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                            >
                                Back to List
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    event: Object,
    users: Array,
    eventTypes: Array,
});

const successMessage = ref("");

const form = useForm({
    title: props.event?.title || "",
    description: props.event?.description || "",
    event_date: props.event?.event_date
        ? props.event.event_date.split("T")[0] // or use dayjs/formatting
        : "",
    // event_date: props.event?.event_date || "",
    location: props.event?.location || "",
    budget: props.event?.budget || 0,
    user_id: props.event?.user_id || "",
    event_type_id: props.event?.event_type_id || "",
    is_planned: props.event?.is_planned ? 1 : 0,
});

// function submit() {
//     form.put(route("event.update", props.event.id), {
//         onSuccess: () => {
//             successMessage.value = "Event updated successfully!";
//             setTimeout(() => {
//                 successMessage.value = "";
//             }, 3000);
//             router.visit(route("event.index"));
//         },
//         onError: () => {
//             successMessage.value = "";
//         },
//     });
function submit() {
    form.put(route("event.update", props.event.id));
}
</script>
