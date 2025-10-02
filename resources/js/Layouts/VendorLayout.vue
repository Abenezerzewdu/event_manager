<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import {
    Home,
    Briefcase,
    User,
    ShoppingBag,
    Image,
    Crown,
    LogOut,
    Sun,
    Moon,
} from "lucide-vue-next";

const isOpen = ref(false);
const isDark = ref(localStorage.getItem("theme") === "dark");

// Handle clicks outside sidebar to close (for mobile)
const handleClickOutside = (event) => {
    if (!event.target.closest("aside") && !event.target.closest("button")) {
        isOpen.value = false;
    }
};
onMounted(() => {
    document.addEventListener("click", handleClickOutside);
    if (isDark.value) document.documentElement.classList.add("dark");
});
onBeforeUnmount(() =>
    document.removeEventListener("click", handleClickOutside)
);

// Watch dark mode toggle
watch(isDark, (val) => {
    if (val) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }
});

// Example user
const user = { name: "Abenezer Zewdu" };

// Logout
const logoutForm = useForm({});
const handleLogout = () => {
    logoutForm.post("/logout");
};
</script>

<template>
    <div class="flex flex-col h-screen bg-gray-100 dark:bg-gray-900 font-sans">
        <!-- TOP NAVBAR STRIP -->
        <div
            class="h-12 flex items-center justify-end px-6 bg-gradient-to-r from-slate-800 to-blue-900 dark:from-gray-900 dark:to-slate-800 text-white shadow fixed top-0 left-0 right-0 z-30"
        >
            <button
                @click="isDark = !isDark"
                class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-white/10 transition"
            >
                <Sun v-if="!isDark" class="w-5 h-5 text-yellow-400" />
                <Moon v-else class="w-5 h-5 text-blue-300" />
                <span class="hidden sm:inline text-sm"
                    >{{ isDark ? "Dark" : "Light" }} Mode</span
                >
            </button>
        </div>

        <div class="flex flex-1 overflow-hidden pt-12">
            <!-- SIDEBAR -->
            <aside
                :class="[
                    'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 w-64 p-5 shadow-xl transform transition-transform duration-300 ease-in-out z-40',
                    isOpen ? 'translate-x-0' : '-translate-x-64',
                    'fixed md:static md:translate-x-0 flex flex-col justify-between h-screen rounded-r-2xl',
                ]"
            >
                <!-- TOP SECTION -->
                <div>
                    <!-- Home -->
                    <div class="mb-6">
                        <Link
                            href="/"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition text-sm"
                        >
                            <Home class="w-5 h-5" />
                            <span>evento 🎈</span>
                        </Link>
                    </div>

                    <!-- Dashboard title -->
                    <h2 class="text-xl font-extrabold mb-8 text-center">
                        Vendor Panel
                    </h2>

                    <!-- Navigation -->
                    <ul class="space-y-3">
                        <li>
                            <Link
                                href="/dashboard"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                            >
                                <Home class="w-5 h-5" /> Overview
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/vendor/services"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                            >
                                <Briefcase class="w-5 h-5" /> Services
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/vendor/profile"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                            >
                                <User class="w-5 h-5" /> Profile
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/vendor/orders"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                            >
                                <ShoppingBag class="w-5 h-5" /> Orders
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/Portfolio"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                            >
                                <Image class="w-5 h-5" /> Portfolio
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/upgradePlan"
                                class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-yellow-500 hover:text-black transition"
                            >
                                <Crown class="w-5 h-5" /> Upgrade Plan
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- BOTTOM SECTION -->
                <div class="mt-6">
                    <!-- Logout -->
                    <button
                        @click="handleLogout"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-red-500/80 hover:text-white transition w-full text-left text-red-500 dark:text-red-300"
                    >
                        <LogOut class="w-5 h-5" />
                        <span>Logout</span>
                    </button>

                    <!-- User Info -->
                    <div
                        class="mt-6 pt-4 border-t border-gray-300 dark:border-gray-700 text-sm text-center"
                    >
                        <p>Logged in as:</p>
                        <p class="font-semibold text-lg">{{ user.name }}</p>
                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="flex-1 flex flex-col">
                <!-- Mobile Toggle -->
                <header
                    class="flex items-center justify-between bg-white dark:bg-gray-800 shadow px-6 py-4 md:hidden"
                >
                    <button
                        class="text-indigo-600 dark:text-indigo-400 font-bold text-2xl"
                        @click.stop="isOpen = !isOpen"
                    >
                        ☰
                    </button>
                </header>

                <!-- Page Content -->
                <main
                    class="p-6 flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                >
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
