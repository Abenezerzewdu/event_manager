<template>
    <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="show"
            class="fixed top-5 right-5 z-50 flex items-center max-w-sm w-full bg-white shadow-lg rounded-xl pointer-events-auto ring-1 ring-black ring-opacity-5 p-4"
        >
            <div class="flex-shrink-0">
                <component :is="icon" class="h-6 w-6" :class="color" />
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium text-gray-900">{{ title }}</p>
                <p v-if="message" class="mt-1 text-sm text-gray-500">
                    {{ message }}
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button
                    class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none"
                    @click="show = false"
                >
                    ✕
                </button>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, watch } from "vue";
import { CheckCircleIcon, ExclamationCircleIcon } from "lucide-vue-next";

const props = defineProps({
    flash: { type: Object, default: () => ({}) },
});

const show = ref(false);
const title = ref("");
const message = ref("");
const icon = ref(null);
const color = ref("");

watch(
    () => props.flash,
    (newFlash) => {
        if (newFlash?.success) {
            title.value = "Success";
            message.value = newFlash.success;
            icon.value = CheckCircleIcon;
            color.value = "text-green-500";
            show.value = true;
        } else if (newFlash?.error) {
            title.value = "Error";
            message.value = newFlash.error;
            icon.value = ExclamationCircleIcon;
            color.value = "text-red-500";
            show.value = true;
        }

        if (show.value) {
            setTimeout(() => {
                show.value = false;
            }, 4000);
        }
    },
    { deep: true, immediate: true }
);
</script>
