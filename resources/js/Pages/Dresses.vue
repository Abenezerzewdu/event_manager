<template>
    <AppHeader />
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section with Video Background -->
        <section class="relative h-96 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-r from-hati-pink to-pink-600"
            ></div>
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>

            <!-- Floating Elements Animation -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    v-for="i in 12"
                    :key="i"
                    :class="[
                        'absolute animate-pulse opacity-20 text-white',
                        getFloatingStyle(i),
                    ]"
                    :style="{ animationDelay: `${i * 0.5}s` }"
                >
                    ❤
                </div>
            </div>

            <div
                class="relative container mx-auto px-4 h-full flex items-center"
            >
                <div class="text-center w-full">
                    <h1
                        class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fade-in"
                    >
                        Dream Dresses
                    </h1>
                    <p class="text-xl text-white mb-8 animate-fade-in-delayed">
                        Find your perfect wedding dress for the most magical day
                        of your life
                    </p>

                    <!-- Animated Search Bar -->
                    <div class="max-w-md mx-auto relative animate-slide-up">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search your dream dress..."
                            class="w-full px-6 py-4 rounded-full text-gray-900 shadow-lg focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50 transition-all"
                        />
                        <button
                            class="absolute right-2 top-2 bg-hati-pink text-white p-2 rounded-full hover:bg-pink-600 transition-colors"
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

        <!-- Filter Tabs -->
        <section class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-wrap gap-4 justify-center">
                    <button
                        v-for="filter in filters"
                        :key="filter"
                        :class="[
                            'px-6 py-2 rounded-full transition-all transform hover:scale-105',
                            activeFilter === filter
                                ? 'bg-hati-pink text-white shadow-lg'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                        ]"
                        @click="setActiveFilter(filter)"
                    >
                        {{ filter }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Dresses Grid -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                    <div
                        v-for="(stat, index) in stats"
                        :key="stat.label"
                        class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div
                            class="text-3xl font-bold text-hati-pink mb-2 animate-counter"
                            :data-target="stat.value"
                        >
                            {{ animatedStats[index] }}+
                        </div>
                        <div class="text-gray-600 text-sm">
                            {{ stat.label }}
                        </div>
                    </div>
                </div>

                <!-- Dress Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
                >
                    <div
                        v-for="(dress, index) in filteredDresses"
                        :key="dress.id"
                        class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                        @click="openDressModal(dress)"
                    >
                        <!-- Image Container -->
                        <div class="relative overflow-hidden aspect-[3/4]">
                            <img
                                :src="dress.image"
                                :alt="dress.name"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            />

                            <!-- Overlay with Price -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            >
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div
                                        class="text-white font-bold text-lg mb-1"
                                    >
                                        {{ dress.name }}
                                    </div>
                                    <div class="text-pink-200">
                                        {{ dress.price }}
                                    </div>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="absolute top-4 left-4 space-y-2">
                                <span
                                    v-if="dress.isNew"
                                    class="bg-green-500 text-white px-2 py-1 text-xs rounded-full"
                                >
                                    New
                                </span>
                                <span
                                    v-if="dress.isPopular"
                                    class="bg-hati-pink text-white px-2 py-1 text-xs rounded-full"
                                >
                                    Popular
                                </span>
                            </div>

                            <!-- Favorite Button -->
                            <button
                                class="absolute top-4 right-4 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-white"
                                @click.stop="toggleFavorite(dress.id)"
                            >
                                <svg
                                    :class="[
                                        'w-5 h-5',
                                        dress.isFavorite
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

                        <!-- Content -->
                        <div class="p-4">
                            <h3
                                class="font-semibold text-gray-900 mb-1 group-hover:text-hati-pink transition-colors"
                            >
                                {{ dress.name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-2">
                                {{ dress.designer }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-hati-pink font-bold">{{
                                    dress.price
                                }}</span>
                                <div class="flex items-center space-x-1">
                                    <svg
                                        class="w-4 h-4 text-yellow-400"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                        />
                                    </svg>
                                    <span class="text-sm text-gray-600">{{
                                        dress.rating
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12" v-if="hasMoreDresses">
                    <button
                        @click="loadMoreDresses"
                        class="bg-hati-pink text-white px-8 py-3 rounded-full hover:bg-pink-600 transition-all transform hover:scale-105 shadow-lg"
                    >
                        Load More Dresses
                    </button>
                </div>
            </div>
        </section>

        <!-- Dress Detail Modal -->
        <div
            v-if="selectedDress"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
            @click="closeDressModal"
        >
            <div
                class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <div class="grid md:grid-cols-2 gap-6 p-6">
                    <!-- Image Gallery -->
                    <div class="space-y-4">
                        <div class="aspect-[3/4] rounded-xl overflow-hidden">
                            <img
                                :src="selectedDress.image"
                                :alt="selectedDress.name"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div
                                v-for="img in selectedDress.gallery"
                                :key="img"
                                class="aspect-square rounded-lg overflow-hidden cursor-pointer hover:opacity-75 transition-opacity"
                            >
                                <img
                                    :src="img"
                                    :alt="selectedDress.name"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ selectedDress.name }}
                            </h2>
                            <p class="text-lg text-gray-600 mb-4">
                                by {{ selectedDress.designer }}
                            </p>
                            <div class="text-2xl font-bold text-hati-pink mb-4">
                                {{ selectedDress.price }}
                            </div>

                            <div class="flex items-center space-x-4 mb-6">
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
                                        selectedDress.rating
                                    }}</span>
                                    <span class="text-gray-600"
                                        >({{
                                            selectedDress.reviews
                                        }}
                                        reviews)</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">
                                Description
                            </h3>
                            <p class="text-gray-600">
                                {{ selectedDress.description }}
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">
                                Size Available
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                <button
                                    v-for="size in selectedDress.sizes"
                                    :key="size"
                                    class="px-3 py-1 border border-gray-300 rounded hover:border-hati-pink hover:text-hati-pink transition-colors"
                                >
                                    {{ size }}
                                </button>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button
                                class="flex-1 bg-hati-pink text-white py-3 rounded-lg hover:bg-pink-600 transition-colors"
                            >
                                Book Appointment
                            </button>
                            <button
                                @click="toggleFavorite(selectedDress.id)"
                                class="px-6 py-3 border border-gray-300 rounded-lg hover:border-hati-pink transition-colors"
                            >
                                <svg
                                    :class="[
                                        'w-5 h-5',
                                        selectedDress.isFavorite
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

                <!-- Close Button -->
                <button
                    @click="closeDressModal"
                    class="absolute top-4 right-4 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors"
                >
                    <svg
                        class="w-5 h-5 text-gray-600"
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
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import AppHeader from "@/Components/AppHeader.vue";
const searchQuery = ref("");
const activeFilter = ref("All Dresses");
const selectedDress = ref(null);
const animatedStats = ref([0, 0, 0, 0]);
const hasMoreDresses = ref(true);

const filters = [
    "All Dresses",
    "A-Line",
    "Ball Gown",
    "Mermaid",
    "Sheath",
    "Tea Length",
    "Vintage",
];

const stats = [
    { label: "Wedding Dresses", value: 500 },
    { label: "Happy Brides", value: 1200 },
    { label: "Designers", value: 50 },
    { label: "Countries", value: 15 },
];

const dresses = ref([
    // all your dresses data stays the same 👗
]);

// --- computed filtering ---
const filteredDresses = computed(() => {
    let filtered = dresses.value;

    if (activeFilter.value !== "All Dresses") {
        filtered = filtered.filter(
            (dress) => dress.category === activeFilter.value
        );
    }

    if (searchQuery.value) {
        filtered = filtered.filter(
            (dress) =>
                dress.name
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                dress.designer
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                dress.category
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase())
        );
    }

    return filtered;
});

// --- methods ---
const setActiveFilter = (filter) => {
    activeFilter.value = filter;
};

const openDressModal = (dress) => {
    selectedDress.value = dress;
};

const closeDressModal = () => {
    selectedDress.value = null;
};

const toggleFavorite = (dressId) => {
    const dress = dresses.value.find((d) => d.id === dressId);
    if (dress) {
        dress.isFavorite = !dress.isFavorite;
    }
};

const loadMoreDresses = () => {
    const newDresses = [
        {
            id: dresses.value.length + 1,
            name: "Princess Grace",
            designer: "Royal Collection",
            price: "Rp 22.000.000",
            rating: 4.9,
            reviews: 145,
            category: "Ball Gown",
            image: "https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
            gallery: [],
            description: "An elegant ball gown inspired by royal fashion.",
            sizes: ["S", "M", "L"],
            isNew: true,
            isPopular: true,
            isFavorite: false,
        },
    ];

    dresses.value.push(...newDresses);

    if (dresses.value.length > 12) {
        hasMoreDresses.value = false;
    }
};

const getFloatingStyle = (index) => {
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
    ];
    return positions[index - 1] || "top-10 left-10";
};

const animateStats = () => {
    stats.forEach((stat, index) => {
        let current = 0;
        const increment = stat.value / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= stat.value) {
                current = stat.value;
                clearInterval(timer);
            }
            animatedStats.value[index] = Math.floor(current);
        }, 20);
    });
};

// --- lifecycle ---
onMounted(() => {
    setTimeout(animateStats, 500);
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
</style>
