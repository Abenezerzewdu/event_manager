<template>
    <div class="p-6">
        <h1>{{ message }}</h1>

        <form
            @submit.prevent="submitForm"
            method="POST"
            action="/eventtype/store"
            class="max-w-md mx-auto mt-6"
        >
            <div class="mb-4">
                <label>Name:</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="border p-2 w-full"
                />
            </div>

            <div class="mb-4">
                <label>Category:</label>
                <select v-model="form.category" class="border p-2 w-full">
                    <option value="">Select Category</option>
                    <option value="planned">Planned</option>
                    <option value="unplanned">Unplanned</option>
                </select>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                :disabled="form.processing"
            >
                <span v-if="form.processing">Submitting...</span>
                <span v-else>Submit</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    message: String,
});

const form = useForm({
    name: "",
    category: "",
});

function submitForm() {
    if (!form.name || !form.category) {
        alert("Please fill all fields!");
        return;
    }

    Inertia.post("/eventtype/store", form);
}
</script>
