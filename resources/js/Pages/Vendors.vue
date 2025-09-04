<template>
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
                    <p class="mb-8 text-xl text-white animate-fade-in-delayed">
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
                        />
                        <button
                            class="absolute p-2 text-white transition-colors rounded-full right-2 top-2 bg-hati-pink hover:bg-pink-600"
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
                        <div class="text-sm opacity-75">{{ stat.label }}</div>
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
                        From stunning dresses to perfect venues, find all the
                        professionals you need for your special day
                    </p>
                </div>

                <!-- Filter Tabs -->
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    <button
                        v-for="category in vendorCategories"
                        :key="category"
                        :class="[
                            'px-6 py-3 rounded-full transition-all transform hover:scale-105 font-medium',
                            activeCategory === category
                                ? 'bg-hati-pink text-white shadow-lg'
                                : 'bg-white text-gray-700 hover:bg-gray-100 shadow-md',
                        ]"
                        @click="setActiveCategory(category)"
                    >
                        {{ category }}
                    </button>
                </div>

                <!-- Vendors Grid -->
                <div
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <div
                        v-for="(vendor, index) in filteredVendors"
                        :key="vendor.id"
                        class="overflow-hidden transition-all duration-300 transform bg-white shadow-lg cursor-pointer group rounded-xl hover:shadow-2xl hover:-translate-y-2"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                        @click="openVendorDetails(vendor)"
                    >
                        <!-- Image Container -->
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img
                                :src="vendor.image"
                                :alt="vendor.name"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110"
                            />

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/60 to-transparent group-hover:opacity-100"
                            >
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div
                                        class="mb-1 text-lg font-bold text-white"
                                    >
                                        {{ vendor.name }}
                                    </div>
                                    <div class="text-sm text-pink-200">
                                        {{ vendor.startingPrice }}
                                    </div>
                                </div>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    :class="[
                                        'px-3 py-1 text-xs font-medium rounded-full text-white',
                                        getCategoryColor(vendor.category),
                                    ]"
                                >
                                    {{ vendor.category }}
                                </span>
                            </div>

                            <!-- Rating Badge -->
                            <div
                                class="absolute flex items-center px-2 py-1 space-x-1 rounded-full top-4 right-4 bg-white/90"
                            >
                                <svg
                                    class="w-4 h-4 text-yellow-400"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                    />
                                </svg>
                                <span
                                    class="text-xs font-medium text-gray-800"
                                    >{{ vendor.rating }}</span
                                >
                            </div>
                        </div>

                        <!-- venors Content -->
                        <div class="p-6">
                            <h3
                                class="mb-2 text-lg font-bold text-gray-900 transition-colors group-hover:text-hati-pink"
                            >
                                {{ vendor.name }}
                            </h3>
                            <p class="mb-3 text-sm text-gray-600 line-clamp-2">
                                {{ vendor.description }}
                            </p>

                            <div class="flex items-center justify-between mb-4">
                                <span class="font-bold text-hati-pink">{{
                                    vendor.startingPrice
                                }}</span>
                                <div
                                    class="flex items-center space-x-1 text-sm text-gray-500"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        ></path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        ></path>
                                    </svg>
                                    <span>{{ vendor.location }}</span>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    v-for="service in vendor.services.slice(
                                        0,
                                        3
                                    )"
                                    :key="service"
                                    class="px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded-full"
                                >
                                    {{ service }}
                                </span>
                                <span
                                    v-if="vendor.services.length > 3"
                                    class="px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded-full"
                                >
                                    +{{ vendor.services.length - 3 }} more
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <button
                                    class="flex-1 px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-hati-pink hover:bg-pink-600"
                                    @click.stop="contactVendor(vendor)"
                                >
                                    Contact
                                </button>
                                <button
                                    class="px-4 py-2 transition-colors border border-gray-300 rounded-lg hover:border-hati-pink hover:text-hati-pink"
                                    @click.stop="toggleFavorite(vendor.id)"
                                >
                                    <svg
                                        :class="[
                                            'w-4 h-4',
                                            vendor.isFavorite
                                                ? 'text-red-500'
                                                : 'text-gray-400',
                                        ]"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="mt-12 text-center" v-if="hasMoreVendors">
                    <button
                        @click="loadMoreVendors"
                        class="px-8 py-3 text-white transition-all transform rounded-full shadow-lg bg-hati-pink hover:bg-pink-600 hover:scale-105"
                    >
                        Load More Vendors
                    </button>
                </div>
            </div>
        </section>

        <!-- Vendor Detail Modal -->
        <div
            v-if="selectedVendor"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            @click="closeVendorModal"
        >
            <div
                class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <div class="relative">
                    <!-- Header Image -->
                    <div class="h-64 overflow-hidden md:h-80 rounded-t-2xl">
                        <img
                            :src="selectedVendor.image"
                            :alt="selectedVendor.name"
                            class="object-cover w-full h-full"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"
                        ></div>

                        <!-- Close Button -->
                        <button
                            @click="closeVendorModal"
                            class="absolute flex items-center justify-center w-10 h-10 transition-colors rounded-full top-4 right-4 bg-white/90 hover:bg-white"
                        >
                            <svg
                                class="w-6 h-6 text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>

                        <!-- Vendor Info Overlay -->
                        <div
                            class="absolute text-white bottom-6 left-6 right-6"
                        >
                            <h2 class="mb-2 text-3xl font-bold">
                                {{ selectedVendor.name }}
                            </h2>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-1">
                                    <svg
                                        class="w-5 h-5 text-yellow-400"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                        />
                                    </svg>
                                    <span class="font-semibold">{{
                                        selectedVendor.rating
                                    }}</span>
                                    <span class="opacity-75"
                                        >({{
                                            selectedVendor.reviews
                                        }}
                                        reviews)</span
                                    >
                                </div>
                                <span class="opacity-75">{{
                                    selectedVendor.location
                                }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 md:p-8">
                        <div class="grid gap-8 md:grid-cols-2">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <h3
                                        class="mb-3 text-xl font-bold text-gray-900"
                                    >
                                        About
                                    </h3>
                                    <p class="leading-relaxed text-gray-600">
                                        {{ selectedVendor.longDescription }}
                                    </p>
                                </div>

                                <div>
                                    <h3
                                        class="mb-3 text-xl font-bold text-gray-900"
                                    >
                                        Services
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            v-for="service in selectedVendor.services"
                                            :key="service"
                                            class="px-3 py-1 text-sm rounded-full bg-hati-pink bg-opacity-10 text-hati-pink"
                                        >
                                            {{ service }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <h3
                                        class="mb-3 text-xl font-bold text-gray-900"
                                    >
                                        Pricing
                                    </h3>
                                    <div class="p-4 rounded-lg bg-gray-50">
                                        <div
                                            class="mb-2 text-2xl font-bold text-hati-pink"
                                        >
                                            {{ selectedVendor.startingPrice }}
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            Starting price - contact for
                                            detailed quotes
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <h3
                                        class="mb-3 text-xl font-bold text-gray-900"
                                    >
                                        Contact Information
                                    </h3>
                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                ></path>
                                            </svg>
                                            <span class="text-gray-600">{{
                                                selectedVendor.phone
                                            }}</span>
                                        </div>
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                ></path>
                                            </svg>
                                            <span class="text-gray-600">{{
                                                selectedVendor.email
                                            }}</span>
                                        </div>
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                ></path>
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                ></path>
                                            </svg>
                                            <span class="text-gray-600">{{
                                                selectedVendor.fullAddress
                                            }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3
                                        class="mb-3 text-xl font-bold text-gray-900"
                                    >
                                        Quick Actions
                                    </h3>
                                    <div class="space-y-3">
                                        <button
                                            v-if="
                                                selectedVendor.category ===
                                                'Wedding Dresses'
                                            "
                                            @click="viewDresses"
                                            class="w-full py-3 font-medium text-white transition-colors rounded-lg bg-hati-pink hover:bg-pink-600"
                                        >
                                            View Dress Collection
                                        </button>
                                        <button
                                            class="w-full py-3 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700"
                                        >
                                            Request Quote
                                        </button>
                                        <button
                                            class="w-full py-3 font-medium text-gray-700 transition-colors border border-gray-300 rounded-lg hover:border-hati-pink hover:text-hati-pink"
                                        >
                                            Schedule Consultation
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AppHeader from "@/Components/AppHeader.vue";
const page = usePage();

const searchQuery = ref("");
const activeCategory = ref("All Categories");
const selectedVendor = ref(null);
const hasMoreVendors = ref(true);

const vendorCategories = [
    "All Categories",
    "Wedding Dresses",
    "Photography",
    "Catering",
    "Venues",
    "Decoration",
    "Music & Entertainment",
    "Beauty & Makeup",
    "Transportation",
];

const stats = [
    { label: "Trusted Vendors", value: 250 },
    { label: "Happy Couples", value: 1500 },
    { label: "Cities Covered", value: 12 },
    { label: "Years Experience", value: 8 },
];

// --- Vendors data (same as your original, trimmed for brevity) ---
const vendors = ref([
    {
        id: 1,
        name: "Bella Couture",
        category: "Wedding Dresses",
        description:
            "Premium wedding dress boutique with designer gowns from renowned international brands.",
        longDescription:
            "Bella Couture has been creating dream wedding experiences for over a decade...",
        image: "https://images.unsplash.com/photo-1594736797933-d0a4e2dded1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
        startingPrice: "Rp 8.000.000",
        rating: 4.9,
        reviews: 234,
        location: "Jakarta Selatan",
        fullAddress: "Jl. Kemang Raya No. 45, Jakarta Selatan",
        phone: "+62 21 5555 1234",
        email: "info@bellacouture.id",
        services: [
            "Designer Gowns",
            "Custom Alterations",
            "Bridal Accessories",
            "Personal Styling",
            "Fitting Services",
        ],
        isFavorite: false,
    },
    // ... rest of vendors
]);

// --- Filtering vendors ---
const filteredVendors = computed(() => {
    let filtered = vendors.value;

    if (activeCategory.value !== "All Categories") {
        filtered = filtered.filter(
            (vendor) => vendor.category === activeCategory.value
        );
    }

    if (searchQuery.value) {
        filtered = filtered.filter(
            (vendor) =>
                vendor.name
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                vendor.category
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                vendor.location
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                vendor.services.some((service) =>
                    service
                        .toLowerCase()
                        .includes(searchQuery.value.toLowerCase())
                )
        );
    }

    return filtered;
});

// --- Actions ---
const setActiveCategory = (category) => {
    activeCategory.value = category;
};

const openVendorDetails = (vendor) => {
    selectedVendor.value = vendor;
};

const closeVendorModal = () => {
    selectedVendor.value = null;
};

const contactVendor = (vendor) => {
    console.log("Contacting vendor:", vendor.name);
};

const toggleFavorite = (vendorId) => {
    const vendor = vendors.value.find((v) => v.id === vendorId);
    if (vendor) {
        vendor.isFavorite = !vendor.isFavorite;
    }
};

const loadMoreVendors = () => {
    hasMoreVendors.value = false;
};

// --- Replaced router.push with Inertia navigation ---
const viewDresses = () => {
    closeVendorModal();
    router.visit("/dresses");
};

// --- Helpers ---
const getCategoryColor = (category) => {
    const colors = {
        "Wedding Dresses": "bg-pink-500",
        Photography: "bg-blue-500",
        Catering: "bg-green-500",
        Venues: "bg-purple-500",
        Decoration: "bg-yellow-500",
        "Music & Entertainment": "bg-red-500",
        "Beauty & Makeup": "bg-indigo-500",
        Transportation: "bg-gray-500",
    };
    return colors[category] || "bg-gray-500";
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

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-delayed {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-fade-in-delayed {
    animation: fade-in-delayed 1s ease-out 0.3s both;
}

.animate-slide-up {
    animation: slide-up 1s ease-out 0.6s both;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
