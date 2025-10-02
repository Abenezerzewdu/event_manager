<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import OrganizerLayout from "@/Layouts/OrganizerLayout.vue";
const props = defineProps({
    event: Object,
});

const form = useForm({
    title: props.event.title,
    description: props.event.description,
    event_date: props.event.event_date,
    location: props.event.location,
    budget: props.event.budget,
    is_planned: props.event.is_planned,
});

const submit = () => {
    form.put(route("organizer.events.update", props.event.id));
};
</script>

<template>
    <OrganizerLayout>
        <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-6">
            <h1 class="text-xl font-bold mb-4">Edit Event</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block font-semibold">Title</label>
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-full border rounded px-3 py-2"
                    />
                    <div v-if="form.errors.title" class="text-red-600 text-sm">
                        {{ form.errors.title }}
                    </div>
                </div>

                <div>
                    <label class="block font-semibold">Description</label>
                    <textarea
                        v-model="form.description"
                        class="w-full border rounded px-3 py-2"
                    ></textarea>
                </div>

                <div>
                    <label class="block font-semibold">Date</label>
                    <input
                        v-model="form.event_date"
                        type="date"
                        class="w-full border rounded px-3 py-2"
                    />
                </div>

                <div>
                    <label class="block font-semibold">Location</label>
                    <input
                        v-model="form.location"
                        type="text"
                        class="w-full border rounded px-3 py-2"
                    />
                </div>

                <div>
                    <label class="block font-semibold">Budget ($)</label>
                    <input
                        v-model="form.budget"
                        type="number"
                        class="w-full border rounded px-3 py-2"
                    />
                </div>

                <div>
                    <label class="block font-semibold">Status</label>
                    <select
                        v-model="form.is_planned"
                        class="w-full border rounded px-3 py-2"
                    >
                        <option :value="true">Planned</option>
                        <option :value="false">Completed</option>
                    </select>
                </div>

                <div class="flex space-x-3">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Update
                    </button>
                    <Link
                        :href="route('organizer.events.index')"
                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </OrganizerLayout>
</template>
