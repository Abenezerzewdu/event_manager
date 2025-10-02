<template>
    <div>
        <AppHeader />
        <div class="min-h-screen bg-gray-50">
            <!-- Hero Section -->
            <section
                class="relative overflow-hidden h-96 bg-gradient-to-br from-hati-pink via-pink-600 to-purple-600"
            >
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                <!-- Floating Elements -->
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        v-for="i in 15"
                        :key="i"
                        :class="[
                            'absolute animate-bounce opacity-20 text-white text-2xl',
                            getFloatingIconStyle(i),
                        ]"
                        :style="{
                            animationDelay: `${i * 0.3}s`,
                            animationDuration: '3s',
                        }"
                    >
                        {{ getFloatingIcon(i) }}
                    </div>
                </div>

                <div
                    class="container relative flex items-center h-full px-4 mx-auto"
                >
                    <div class="w-full text-center">
                        <h1
                            class="mb-6 text-5xl font-bold text-white md:text-6xl animate-fade-in"
                        >
                            Wedding Vendors
                        </h1>
                        <p
                            class="mb-8 text-xl text-white animate-fade-in-delayed"
                        >
                            Discover trusted professionals to make your wedding
                            dreams come true
                        </p>

                        <!-- Search Bar -->
                        <div class="relative max-w-lg mx-auto animate-slide-up">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Search vendors, services, or locations..."
                                class="w-full px-6 py-4 text-gray-900 transition-all rounded-full shadow-lg pr-14 focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50"
                                @keyup.enter="performSearch"
                            />
                            <button
                                type="button"
                                @click="performSearch"
                                class="absolute p-2.5 text-white rounded-full right-2 top-2 bg-blue-500 hover:bg-blue-600 active:bg-blue-700 shadow-md hover:shadow-lg active:shadow-inner transition duration-200"
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
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="py-12 bg-white">
                <div class="container px-4 mx-auto">
                    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                        <div
                            v-for="(stat, index) in stats"
                            :key="stat.label"
                            class="p-6 text-center transition-all duration-300 transform cursor-pointer bg-gray-50 rounded-xl hover:bg-hati-pink hover:text-white hover:-translate-y-1"
                            :style="{ animationDelay: `${index * 0.1}s` }"
                        >
                            <div class="mb-2 text-3xl font-bold">
                                {{ stat.value }}+
                            </div>
                            <div class="text-sm opacity-75">
                                {{ stat.label }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Vendor Categories -->
            <section class="py-16">
                <div class="container px-4 mx-auto">
                    <div class="mb-12 text-center">
                        <h2 class="mb-4 text-4xl font-bold text-gray-900">
                            Our Vendor Categories
                        </h2>
                        <p class="max-w-3xl mx-auto text-xl text-gray-600">
                            From stunning dresses to perfect venues, find all
                            the professionals you need for your special day
                        </p>
                    </div>
                </div>
            </section>
            <!-- Filter Tabs -->

            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <button
                    v-for="category in ['All Categories', ...categories]"
                    :key="category"
                    @click="setActiveCategory(category)"
                    :class="[
                        'px-6 py-2 rounded-full font-medium transition-colors duration-200 border',
                        activeCategory.toLowerCase() === category.toLowerCase()
                            ? 'bg-indigo-100 text-indigo-700 border-indigo-300 shadow-sm'
                            : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-100',
                    ]"
                >
                    {{ category }}
                </button>
            </div>

            <div
                id="vendors-grid"
                v-if="vendors.data.length > 0"
                class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
            >
                <VendorServiceCard
                    v-for="vendor in vendors.data"
                    :key="vendor.id"
                    :vendor="vendor"
                />
            </div>

            <div v-else class="text-center py-16">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    No vendors found
                </h3>
                <p class="text-gray-600">
                    We couldn't find any vendors . Try selecting another
                    category.
                </p>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <nav class="flex space-x-2">
                    <template v-for="link in vendors.links" :key="link.label">
                        <button
                            v-if="link.url"
                            @click="
                                router.get(
                                    link.url,
                                    { category: activeCategory },
                                    { preserveScroll: true }
                                )
                            "
                            v-html="link.label"
                            :class="[
                                'px-3 py-1 rounded-lg border text-sm font-medium transition',
                                link.active
                                    ? 'bg-indigo-600 text-white border-indigo-600'
                                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100',
                            ]"
                        />
                        <span
                            v-else
                            v-html="link.label"
                            class="px-3 py-1 rounded-lg text-gray-400 border border-gray-200 text-sm"
                        />
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, onMounted } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AppHeader from "@/Components/AppHeader.vue";
import VendorServiceCard from "@/Components/VendorServiceCard.vue";

defineProps({
    vendors: Object,
    categories: Array,
    activeCategory: String,
});
const page = usePage();
const vendors = computed(() => page.props.vendors || []);

const performSearch = () => {
    if (!searchQuery.value.trim()) return;

    // Send search query to backend
    router.get(
        route("vendors.all"),
        { search: searchQuery.value },
        {
            preserveScroll: true,
            onSuccess: () => {
                // Scroll to the vendors grid after search
                const grid = document.getElementById("vendors-grid");
                if (grid) {
                    grid.scrollIntoView({ behavior: "smooth" });
                }
            },
        }
    );
};

// Filter vendors dynamically
const filteredVendors = computed(() => {
    if (activeCategory.value === "All Categories") return vendors.value;

    return vendors.value.filter(
        (vendor) => vendor.service_name === activeCategory.value
    );
});

const setActiveCategory = (category) => {
    router.get(route("vendors.all"), { category }, { preserveScroll: true });
};

const placeOrder = (vendor) => {
    router.post("/orders", {
        vendor_id: vendor.id,
        service_id: vendor.services[0]?.id, // just first service for now
        event_id: 1,
    });
};

const searchQuery = ref("");
const selectedVendor = ref(null);

// Categories coming from Laravel backend
const vendorCategories = ref(["All Categories", ...page.props.categories]);

const stats = [
    { label: "Trusted Vendors", value: 250 },
    { label: "Happy Couples", value: 1500 },
    { label: "Cities Covered", value: 12 },
    { label: "Years Experience", value: 8 },
];

const openVendorDetails = (vendor) => {
    selectedVendor.value = vendor;
};

const closeVendorModal = () => {
    selectedVendor.value = null;
};

const getFloatingIcon = (index) => {
    const icons = [
        "💐",
        "📸",
        "🍰",
        "🎵",
        "💒",
        "💍",
        "👗",
        "🎉",
        "🌸",
        "✨",
        "💖",
        "🥂",
        "🎭",
        "🚗",
        "💄",
    ];
    return icons[index - 1] || "💝";
};

const getFloatingIconStyle = (index) => {
    const positions = [
        "top-10 left-10",
        "top-20 right-20",
        "top-40 left-1/4",
        "top-60 right-1/3",
        "top-80 left-1/2",
        "top-32 right-10",
        "top-16 left-1/3",
        "top-72 right-1/4",
        "top-24 left-20",
        "top-56 right-16",
        "top-44 left-16",
        "top-64 right-1/2",
        "top-12 left-1/5",
        "top-36 right-1/5",
        "top-68 left-3/4",
    ];
    return positions[index - 1] || "top-10 left-10";
};

// --- onMounted replaces route.query.search with Inertia-friendly approach ---
onMounted(() => {
    if (page.props.search) {
        searchQuery.value = page.props.search;
    }
});
</script>
