<template>
    <AppHeader />
    <div class="min-h-screen bg-white">
        <!-- Search Section -->
        <section class="bg-gray-50 py-8">
            <div class="container mx-auto px-4">
                <!-- Search Bar -->
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center space-y-3 md:space-y-0 md:space-x-4 mb-6"
                >
                    <button
                        @click="showCategoryModal = true"
                        class="flex items-center justify-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
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
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                        </svg>
                        <span>Kategori</span>
                    </button>

                    <div class="flex-1 flex">
                        <input
                            type="text"
                            placeholder="Cari Venue atau Lokasi"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                        />
                        <button
                            class="bg-hati-pink text-white px-4 md:px-6 py-2 rounded-r-lg hover:bg-pink-600 transition-colors"
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

                    <button
                        @click="showCalendar = true"
                        class="flex items-center justify-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
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
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            ></path>
                        </svg>
                    </button>
                </div>

                <!-- Filter Tabs -->
                <div
                    class="flex space-x-3 md:space-x-6 border-b border-gray-200 overflow-x-auto"
                >
                    <button
                        v-for="tab in filterTabs"
                        :key="tab"
                        :class="[
                            'pb-3 px-1 text-sm font-medium border-b-2 transition-colors whitespace-nowrap',
                            activeTab === tab
                                ? 'border-hati-pink text-hati-pink'
                                : 'border-transparent text-gray-500 hover:text-gray-700',
                        ]"
                        @click="activeTab = tab"
                    >
                        {{ tab }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Venue Grid -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                >
                    <div
                        v-for="venue in venues"
                        :key="venue.id"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        <div class="relative">
                            <img
                                :src="venue.image"
                                :alt="venue.name"
                                class="w-full h-48 object-cover"
                            />
                            <span
                                :class="[
                                    'absolute top-3 left-3 px-2 py-1 text-xs font-medium text-white rounded',
                                    venue.category === 'Outdoor'
                                        ? 'bg-blue-500'
                                        : venue.category === 'Indoor'
                                        ? 'bg-yellow-500'
                                        : 'bg-green-500',
                                ]"
                            >
                                {{ venue.category }}
                            </span>
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">
                                {{ venue.name }}
                            </h3>
                            <p
                                class="text-sm text-gray-600 mb-2 flex items-center"
                            >
                                <svg
                                    class="w-4 h-4 mr-1"
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
                                {{ venue.location }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Modal -->
        <div
            v-if="showCategoryModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click="showCategoryModal = false"
        >
            <div
                class="bg-white rounded-xl p-6 max-w-md w-full mx-4"
                @click.stop
            >
                <h3 class="text-lg font-semibold mb-4">Pilih Kategori</h3>
                <div class="grid grid-cols-2 gap-3">
                    <button
                        v-for="category in categories"
                        :key="category.name"
                        :class="[
                            'flex items-center space-x-3 p-3 border rounded-lg transition-colors text-left',
                            selectedCategory === category.name
                                ? 'border-hati-pink bg-hati-pink bg-opacity-10'
                                : 'border-gray-200 hover:bg-gray-50',
                        ]"
                        @click="selectCategory(category)"
                    >
                        <div
                            :class="[
                                'w-8 h-8 rounded flex items-center justify-center',
                                selectedCategory === category.name
                                    ? 'bg-hati-pink bg-opacity-20'
                                    : 'bg-blue-100',
                            ]"
                        >
                            <svg
                                :class="[
                                    'w-5 h-5',
                                    selectedCategory === category.name
                                        ? 'text-hati-pink'
                                        : 'text-blue-600',
                                ]"
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
                        <span
                            :class="[
                                'text-sm',
                                selectedCategory === category.name
                                    ? 'font-bold text-hati-pink'
                                    : 'font-medium',
                            ]"
                            >{{ category.name }}</span
                        >
                    </button>
                </div>
            </div>
        </div>

        <!-- Calendar Modal -->
        <div
            v-if="showCalendar"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click="showCalendar = false"
        >
            <div
                class="bg-white rounded-xl p-6 max-w-sm w-full mx-4"
                @click.stop
            >
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">
                        {{ currentMonthName }} {{ currentYear }}
                    </h3>
                    <div class="flex space-x-2">
                        <button
                            @click="previousMonth"
                            class="p-1 hover:bg-gray-100 rounded"
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
                                    d="M15 19l-7-7 7-7"
                                ></path>
                            </svg>
                        </button>
                        <button
                            @click="nextMonth"
                            class="p-1 hover:bg-gray-100 rounded"
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
                                    d="M9 5l7 7-7 7"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-1 text-center text-sm">
                    <div
                        v-for="day in [
                            'Su',
                            'Mo',
                            'Tu',
                            'We',
                            'Th',
                            'Fr',
                            'Sa',
                        ]"
                        :key="day"
                        class="p-2 font-medium text-gray-500"
                    >
                        {{ day }}
                    </div>
                    <div
                        v-for="(date, index) in calendarDates"
                        :key="index"
                        :class="[
                            'p-2 rounded cursor-pointer transition-colors',
                            date ? 'hover:bg-gray-100' : '',
                            selectedDate === date && date
                                ? 'bg-hati-pink text-white'
                                : '',
                            date === today &&
                            currentMonth === new Date().getMonth() &&
                            currentYear === new Date().getFullYear()
                                ? 'bg-blue-100 font-semibold'
                                : '',
                        ]"
                    >
                        {{ date || "" }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import AppHeader from "@/Components/AppHeader.vue";
const activeTab = ref("Di sekitar saya");
const showCategoryModal = ref(false);
const showCalendar = ref(false);
const selectedCategory = ref<string | null>(null);

// Calendar state
const currentMonth = ref(11); // December (0-indexed)
const currentYear = ref(2021);
const selectedDate = ref<number | null>(null);
const today = new Date().getDate();

const monthNames = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
];

const currentMonthName = computed(() => monthNames[currentMonth.value]);

const filterTabs = ["Di sekitar saya", "Terbaru", "Populer", "Spesial Offer!"];

const venues = ref([
    {
        id: 1,
        name: "The Aesthetic",
        location: "Bekasi, Jawa Barat",
        category: "Outdoor",
        image: "https://images.unsplash.com/photo-1519167758481-83f29b1fe739?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 2,
        name: "Resonances",
        location: "Bekasi, Jawa Barat",
        category: "Indoor",
        image: "https://images.unsplash.com/photo-1464207687429-7505649dae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 3,
        name: "Nomade",
        location: "Bekasi, Jawa Barat",
        category: "Indoor",
        image: "https://images.unsplash.com/photo-1571058632277-4eda2c7b4e3c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 4,
        name: "Tropical",
        location: "Bekasi, Jawa Barat",
        category: "Indoor",
        image: "https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 5,
        name: "Urban Loft",
        location: "Jakarta, Indonesia",
        category: "Indoor",
        image: "https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 6,
        name: "Garden Paradise",
        location: "Bandung, Jawa Barat",
        category: "Outdoor",
        image: "https://images.unsplash.com/photo-1469371670807-013ccf25f16a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 7,
        name: "Classic Ballroom",
        location: "Surabaya, Jawa Timur",
        category: "Indoor",
        image: "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
    {
        id: 8,
        name: "Rustic Barn",
        location: "Yogyakarta, Indonesia",
        category: "Outdoor",
        image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80",
    },
]);

const categories = ref([
    { name: "Kue dan Katering" },
    { name: "Desain Undangan" },
    { name: "Desain Website" },
    { name: "Pawang Hujan" },
    { name: "Wedding Organizer" },
    { name: "Ceremony Music" },
    { name: "Favors & Gift" },
    { name: "Dresses" },
    { name: "Decor" },
    { name: "Ideas" },
    { name: "Venue" },
]);

const calendarDates = computed(() => {
    const firstDay = new Date(currentYear.value, currentMonth.value, 1);
    const lastDay = new Date(currentYear.value, currentMonth.value + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = firstDay.getDay();

    const dates: (number | string)[] = [];

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDayOfWeek; i++) {
        dates.push("");
    }

    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        dates.push(day);
    }

    // Add empty cells to complete the week
    while (dates.length % 7 !== 0) {
        dates.push("");
    }

    return dates;
});

const previousMonth = () => {
    if (currentMonth.value === 0) {
        currentMonth.value = 11;
        currentYear.value--;
    } else {
        currentMonth.value--;
    }
    selectedDate.value = null;
};

const nextMonth = () => {
    if (currentMonth.value === 11) {
        currentMonth.value = 0;
        currentYear.value++;
    } else {
        currentMonth.value++;
    }
    selectedDate.value = null;
};

const selectDate = (date: number) => {
    selectedDate.value = date;
    console.log(
        `Selected date: ${date}/${currentMonth.value + 1}/${currentYear.value}`
    );
};

const selectCategory = (category: any) => {
    selectedCategory.value = category.name;
    console.log("Selected category:", category.name);
    showCategoryModal.value = false;
};
</script>
