<template>
    <div class="min-h-screen bg-white">
        <AppHeader />
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gray-50">
            <!-- Diagonal stripes decoration -->
            <div
                class="absolute top-0 right-0 w-80 h-full bg-diagonal-stripes"
            ></div>

            <div class="container mx-auto px-4 py-8 md:py-12 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <!-- Left Content -->
                    <div class="lg:max-w-lg order-2 lg:order-1">
                        <h1
                            class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6"
                        >
                            When your <span class="text-red-500">❤</span><br />
                            <span class="text-blue-600">Dream Wedding</span>
                            come true
                        </h1>

                        <p class="text-gray-600 mb-8 text-lg">
                            "Once in a while, right in the middle of an ordinary
                            life, love gives us a fairy tale."
                        </p>

                        <!-- Search Bar -->
                        <div class="flex mb-8">
                            <form
                                @submit.prevent="searchVendors"
                                class="flex-1 flex"
                            >
                                <input
                                    v-model="homeSearchQuery"
                                    type="text"
                                    placeholder="Photographer, catering, venue"
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    @keyup.enter="searchVendors"
                                />
                                <button
                                    type="submit"
                                    class="bg-hati-pink text-white px-6 py-3 rounded-r-lg hover:bg-pink-600 transition-colors"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                        ></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Service Icons -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-hati-pink bg-opacity-10 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="w-6 h-6 text-hati-pink"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        create
                                    </h3>
                                    <p class="text-sm text-gray-600">manage</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="w-6 h-6 text-red-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        find
                                    </h3>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="w-6 h-6 text-blue-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        Buy
                                    </h3>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="w-6 h-6 text-purple-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        Enable
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Wedding Image -->
                    <div class="relative order-1 lg:order-2">
                        <div
                            class="relative z-10 rounded-2xl overflow-hidden shadow-2xl"
                        >
                            <img
                                src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Wedding couple"
                                class="w-full h-[300px] md:h-[400px] lg:h-[500px] object-cover"
                            />
                            <!-- Play button overlay -->
                            <div
                                class="absolute inset-0 flex items-center justify-center"
                            >
                                <button
                                    class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center shadow-lg hover:bg-opacity-100 transition-all"
                                >
                                    <svg
                                        class="w-6 h-6 text-hati-pink ml-1"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-8">
                <div class="w-px h-12 bg-gray-300 mb-4"></div>
                <p
                    class="text-sm text-gray-500 transform -rotate-90 origin-left"
                >
                    Scroll Down
                </p>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppHeader from "@/Components/AppHeader.vue";
const homeSearchQuery = ref("");

const searchVendors = () => {
    if (homeSearchQuery.value.trim()) {
        // Inertia navigation with query params
        router.get("/vendors", { search: homeSearchQuery.value.trim() });
    } else {
        // Navigate without query
        router.get("/vendors");
    }
};
</script>
