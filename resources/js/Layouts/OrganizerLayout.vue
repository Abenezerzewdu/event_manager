<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import {
    LayoutDashboard,
    Calendar,
    Users,
    ShoppingBag,
    Sun,
    Moon,
    LogOut,
    Sparkles,
} from "lucide-vue-next";

const isOpen = ref(false);
const isDark = ref(false);
const user = { name: "Organizer Name" }; // Replace with Inertia prop later

const logoutForm = useForm({});
const handleLogout = () => logoutForm.post("/logout");

const handleClickOutside = (event) => {
    if (
        !event.target.closest("aside") &&
        !event.target.closest("[data-sidebar-toggle]")
    ) {
        isOpen.value = false;
    }
};

onMounted(() => document.addEventListener("click", handleClickOutside));
onBeforeUnmount(() =>
    document.removeEventListener("click", handleClickOutside)
);

watch(isDark, (val) => {
    document.documentElement.classList.toggle("dark", val);
});
</script>

<template>
    <div
        class="flex flex-col h-screen font-sans bg-gray-100 dark:bg-gray-950 transition-colors"
    >
        <!-- Topbar -->
        <header
            class="h-14 flex items-center justify-between px-6 bg-gradient-to-r from-gray-100 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-indigo-950 text-gray-800 dark:text-gray-100 shadow-md relative z-30 border-b border-gray-200/50 dark:border-gray-700/50"
        >
            <!-- Left: Logo & Mobile Toggle -->
            <div class="flex items-center gap-3">
                <button
                    data-sidebar-toggle
                    class="md:hidden text-2xl font-bold text-indigo-700 dark:text-indigo-400 hover:text-indigo-500 transition"
                    @click.stop="isOpen = !isOpen"
                >
                    ☰
                </button>
                <Link
                    href="/"
                    class="flex items-center gap-2 font-semibold text-indigo-700 dark:text-indigo-400 text-lg hover:opacity-80 transition"
                >
                    <Sparkles class="w-5 h-5" />
                    <span>evento</span>
                </Link>
            </div>

            <!-- Right: Dark/Light Mode -->
            <button
                @click="isDark = !isDark"
                class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-gray-200/40 dark:hover:bg-gray-700/50 transition"
            >
                <Sun v-if="!isDark" class="w-5 h-5 text-yellow-400" />
                <Moon v-else class="w-5 h-5 text-blue-300" />
                <span class="hidden sm:inline text-sm font-medium">
                    {{ isDark ? "Dark" : "Light" }} Mode
                </span>
            </button>
        </header>

        <!-- Main Section -->
        <div class="flex flex-1 overflow-hidden relative">
            <!-- Sidebar -->
            <aside
                :class="[
                    'fixed md:static left-0 top-0 h-full md:h-auto z-40 w-64 backdrop-blur-xl bg-white/80 dark:bg-gray-800/80',
                    'shadow-2xl md:shadow-none transform transition-transform duration-300 ease-in-out border-r border-gray-200/40 dark:border-gray-700/30 rounded-r-3xl',
                    isOpen
                        ? 'translate-x-0'
                        : '-translate-x-64 md:translate-x-0',
                ]"
            >
                <div class="flex flex-col justify-between h-full p-6">
                    <div>
                        <h2
                            class="text-lg font-bold mb-6 text-center text-gray-700 dark:text-gray-200 tracking-wide"
                        >
                            Organizer Panel
                        </h2>

                        <ul class="space-y-2 text-sm font-medium">
                            <li>
                                <Link
                                    href="/organizer/dashboard"
                                    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                >
                                    <LayoutDashboard class="w-5 h-5" /> Overview
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/organizer/events"
                                    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                >
                                    <Calendar class="w-5 h-5" /> My Events
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/my-orders"
                                    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-yellow-500 hover:text-black transition"
                                >
                                    <ShoppingBag class="w-5 h-5" /> My Orders
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/organizer/vendors"
                                    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                >
                                    <Users class="w-5 h-5" /> Vendors
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Bottom Section -->
                    <div
                        class="mt-8 border-t border-gray-300/40 dark:border-gray-600/30 pt-4"
                    >
                        <button
                            @click="handleLogout"
                            class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-red-600 hover:text-white w-full transition text-red-500 font-medium"
                        >
                            <LogOut class="w-5 h-5" /> Logout
                        </button>

                        <div class="mt-5 text-center text-sm">
                            <p class="opacity-70">Logged in as:</p>
                            <p
                                class="font-semibold text-gray-900 dark:text-gray-200 mt-1"
                            >
                                {{ user.name }}
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main
                class="flex-1 overflow-y-auto p-6 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition"
            >
                <slot />
            </main>
        </div>
    </div>
</template>
