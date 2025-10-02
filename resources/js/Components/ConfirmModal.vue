<template>
    <div
        v-if="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
    >
        <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                {{ title }}
            </h2>
            <p class="text-gray-600 mb-6">
                {{ message }}
            </p>

            <div class="flex justify-end gap-3">
                <button
                    @click="close"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition"
                >
                    Cancel
                </button>
                <button
                    @click="confirm"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                >
                    Confirm
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    show: Boolean,
    title: { type: String, default: "Are you sure?" },
    message: { type: String, default: "This action cannot be undone." },
});

const emit = defineEmits(["close", "confirm"]);

const close = () => emit("close");
const confirm = () => emit("confirm");
</script>
