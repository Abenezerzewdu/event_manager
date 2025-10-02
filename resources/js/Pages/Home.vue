<template>
    <div
        class="relative min-h-screen overflow-hidden bg-gradient-to-br from-pink-50 via-white to-blue-50"
    >
        <AppHeader :cart-items="cartItems" />

        <!-- Hero Section -->
        <section
            class="relative grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-8 lg:px-20 py-24"
        >
            <!-- Left Content -->
            <div class="z-10">
                <h1
                    class="text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6"
                >
                    Plan <span class="text-pink-600">Beautiful Events</span
                    ><br />
                    Without the
                    <span
                        class="bg-gradient-to-r from-yellow-400 to-red-400 bg-clip-text text-transparent"
                        >Chaos</span
                    >
                </h1>

                <p class="text-lg text-gray-600 mb-10 max-w-lg">
                    We turn stressful event management into a seamless
                    experience. Organize vendors, guests, and schedules in one
                    elegant platform — so you can focus on making memories.
                </p>

                <button
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-400 text-white text-lg font-semibold rounded-full shadow-lg hover:scale-105 hover:shadow-2xl transform transition"
                    @click="goToCreateEvent"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Create Event
                </button>
            </div>

            <!-- Right Visual Chaos -->
            <div class="relative">
                <!-- Floating colorful blobs -->
                <div
                    class="absolute w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"
                ></div>
                <div
                    class="absolute w-72 h-72 bg-yellow-400 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"
                ></div>
                <div
                    class="absolute w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"
                ></div>

                <!-- Foreground illustration / chaos box -->
                <div
                    class="relative z-10 bg-white shadow-xl rounded-3xl p-8 border border-gray-100"
                >
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        The Mess Behind The Scenes
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <span
                                class="w-2 h-2 bg-pink-500 rounded-full mr-3"
                            ></span>
                            Vendor coordination
                        </li>
                        <li class="flex items-center">
                            <span
                                class="w-2 h-2 bg-yellow-500 rounded-full mr-3"
                            ></span>
                            Guest list management
                        </li>
                        <li class="flex items-center">
                            <span
                                class="w-2 h-2 bg-blue-500 rounded-full mr-3"
                            ></span>
                            Scheduling nightmares
                        </li>
                        <li class="flex items-center">
                            <span
                                class="w-2 h-2 bg-red-500 rounded-full mr-3"
                            ></span>
                            Budget juggling
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import AppHeader from "@/Components/AppHeader.vue";
import { router } from "@inertiajs/vue3";

defineProps({
    cartItems: Array,
});

const goToCreateEvent = () => {
    router.get(route("event.create"));
};
</script>

<style scoped>
@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}
.animate-blob {
    animation: blob 8s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
