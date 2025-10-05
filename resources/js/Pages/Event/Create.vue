<template>
    <OrganizerLayout>
        <div class="min-h-screen py-10 bg-gray-50">
            <div class="max-w-3xl mx-auto px-6">
                <!-- Page Header -->
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-semibold text-gray-800">
                        ✨ Create Your Event
                    </h1>
                    <p class="text-gray-500 mt-2">
                        A simple, calm space to plan something amazing.
                    </p>
                </div>

                <!-- Notion-like Form -->
                <form @submit.prevent="submit" class="space-y-10">
                    <!-- Event Title -->
                    <div>
                        <input
                            v-model="form.title"
                            type="text"
                            placeholder="Event title (e.g. Summer Gala, Tech Meetup...)"
                            class="w-full text-2xl font-medium text-gray-800 bg-transparent border-0 border-b border-gray-200 focus:border-blue-400 focus:ring-0 placeholder-gray-400"
                            required
                        />
                        <span
                            v-if="form.errors.title"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.title }}
                        </span>
                    </div>

                    <!-- Date & Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">
                                Event Date
                            </label>
                            <input
                                v-model="form.event_date"
                                type="date"
                                min="2025-09-01"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0"
                                required
                            />
                            <span
                                v-if="form.errors.event_date"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.event_date }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-500 mb-1">
                                Event Type
                            </label>
                            <select
                                v-model="form.event_type_id"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0"
                                required
                            >
                                <option value="">Select type...</option>
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
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.event_type_id }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <textarea
                            v-model="form.description"
                            rows="4"
                            placeholder="Write a short description for your event..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0 resize-none"
                        ></textarea>
                        <span
                            v-if="form.errors.description"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.description }}
                        </span>
                    </div>

                    <!-- Location & Budget -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">
                                Location
                            </label>
                            <input
                                v-model="form.location"
                                type="text"
                                placeholder="Add event location..."
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0"
                                required
                            />
                            <span
                                v-if="form.errors.location"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.location }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-500 mb-1">
                                Budget ($)
                            </label>
                            <input
                                v-model="form.budget"
                                type="number"
                                step="0.01"
                                placeholder="0.00"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0"
                                required
                            />
                            <span
                                v-if="form.errors.budget"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.budget }}
                            </span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">
                            Status
                        </label>
                        <select
                            v-model="form.status"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:border-blue-400 focus:ring-0"
                            required
                        >
                            <option value="pre-planning">Pre-Planning</option>
                            <option value="planning">Planning</option>
                            <option value="completed">Completed</option>
                        </select>
                        <span
                            v-if="form.errors.is_planned"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.is_planned }}
                        </span>
                    </div>

                    <!-- Submit / Cancel -->
                    <div
                        class="flex justify-end space-x-4 pt-6 border-t border-gray-100"
                    >
                        <Link
                            :href="route('event.index')"
                            class="px-5 py-2.5 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            Cancel
                        </Link>

                        <button
                            type="submit"
                            class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center"
                            :disabled="form.processing"
                        >
                            <svg
                                v-if="form.processing"
                                class="w-4 h-4 mr-2 animate-spin"
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
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                ></path>
                            </svg>
                            {{
                                form.processing ? "Creating..." : "Create Event"
                            }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </OrganizerLayout>
</template>

<script setup>
import { useForm, Link, router } from "@inertiajs/vue3";
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";

const props = defineProps({
    users: Array,
    eventTypes: Array,
});

const form = useForm({
    title: "",
    description: "",
    event_date: "",
    location: "",
    budget: 0,
    user_id: "",
    event_type_id: "",
    status: "pre-planning",
});

function submit() {
    form.post(route("event.store"), {
        onSuccess: () => {
            form.reset();
            router.visit(route("event.show"));
        },
    });
}
</script>
