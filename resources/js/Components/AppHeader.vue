<template>
    <header class="bg-white border-b border-gray-100 shadow-sm">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <Link href="/" class="flex items-center space-x-2 group">
                    <span
                        class="text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-hati-pink"
                    >
                        evento🎈
                    </span>
                </Link>

                <!-- Navigation for desktop -->
                <nav class="items-center hidden space-x-8 md:flex">
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-1 text-gray-700 transition-colors hover:text-hati-pink"
                        >
                            <span>Services</span>
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
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute left-0 z-50 invisible w-48 mt-2 transition-all bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 top-full group-hover:opacity-100 group-hover:visible"
                        >
                            <div class="py-2">
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >Photography</a
                                >
                                <Link
                                    href="/venue"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >Venue</Link
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >Decoration</a
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >Music</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- events dropdown -->
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-1 text-gray-700 transition-colors hover:text-hati-pink"
                        >
                            <span>Events</span>
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
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute left-0 z-50 invisible w-48 mt-2 transition-all bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 top-full group-hover:opacity-100 group-hover:visible"
                        >
                            <div
                                class="py-2"
                                v-for="event in events"
                                :key="event.id"
                            >
                                <a
                                    href="/"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >{{ event.name }}</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- vendors link -->
                    <Link
                        href="/vendors"
                        class="text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Vendors
                    </Link>

                    <!-- contact us link -->
                    <Link
                        href="/contact"
                        class="text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Contact
                    </Link>
                </nav>

                <!-- Right Side -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <!-- become a vendor -->
                    <button
                        v-if="!$page.props.auth.user?.isVendor"
                        @click="openVendorRegistration"
                        class="hidden px-3 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 lg:block"
                    >
                        Become Vendor
                    </button>

                    <!-- conditional dashboard routed -->
                    <button
                        class="hidden text-gray-700 transition-colors hover:text-hati-pink md:block"
                    >
                        <Link v-if="authed" :href="route('dashboard')"
                            >Dashboard
                        </Link>
                    </button>

                    <button
                        class="px-3 py-2 text-sm text-black transition-colors rounded-lg md:px-4 md:py-2 bg-blur md:text-base"
                    >
                        Templates
                    </button>

                    <!-- Cart -->
                    <div class="relative">
                        <button
                            ref="cartButtonRef"
                            @click.stop="toggleCart"
                            class="relative p-2 text-gray-700 hover:text-hati-pink"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l-2.5-5M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"
                                ></path>
                            </svg>
                            <span
                                v-if="cartItems.length > 0"
                                class="absolute flex items-center justify-center w-5 h-5 text-xs text-white rounded-full -top-1 -right-1 bg-hati-pink"
                            >
                                {{ cartItems.length }}
                            </span>
                        </button>

                        <div
                            v-if="showCart"
                            ref="cartDropdownRef"
                            class="absolute right-0 z-50 mt-2 bg-white border shadow-lg top-full w-80 rounded-xl"
                        >
                            <div
                                class="p-4 border-b flex items-center justify-between"
                            >
                                <h3 class="font-semibold">
                                    Your Basket ({{ cartItems.length }})
                                </h3>
                                <button
                                    @click="showCart = false"
                                    class="text-gray-400 hover:text-gray-600"
                                >
                                    ✕
                                </button>
                            </div>

                            <div class="overflow-y-auto max-h-64">
                                <div
                                    v-if="cartItems.length === 0"
                                    class="p-4 text-center text-gray-500"
                                >
                                    Your basket is empty
                                </div>

                                <div v-else>
                                    <div
                                        v-for="item in cartItems"
                                        :key="item.id"
                                        class="flex items-center p-4 space-x-3 border-b border-gray-50"
                                    >
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium">
                                                {{ item.vendor }} -
                                                {{ item.service }}
                                            </h4>
                                            <p
                                                class="text-sm font-bold text-hati-pink"
                                            >
                                                {{ item.price }} br
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <Link
                                            href="/organizer/orders"
                                            class="w-full py-2 text-white bg-blue-600 rounded-lg text-center hover:bg-blue-700"
                                        >
                                            View Orders
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button
                        @click="showMobileNav = !showMobileNav"
                        class="p-2 md:hidden"
                    >
                        <svg
                            class="w-6 h-6"
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
                    </button>
                </div>

                <!-- Mobile Navigation -->
                <nav
                    v-if="showMobileNav"
                    class="absolute left-0 w-full px-4 py-4 space-y-2 bg-white border-t border-gray-100 md:hidden"
                >
                    <Link
                        href="/vendors"
                        class="block text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Vendors
                    </Link>
                    <Link
                        href="/contact"
                        class="block text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Contact
                    </Link>
                    <button
                        v-if="!$page.props.auth.user?.isVendor"
                        @click="openVendorRegistration"
                        class="w-full px-3 py-2 text-white bg-blue-600 rounded-lg"
                    >
                        Become Vendor
                    </button>
                    <Link
                        v-if="authed"
                        :href="route('dashboard')"
                        class="block text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Dashboard
                    </Link>
                </nav>

                <VendorsModal
                    :show="showVendorModal"
                    @click="closeVendorModal"
                />
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed, onMounted } from "vue";
import { defineProps } from "vue";
import { usePage } from "@inertiajs/vue3";
import VendorsModal from "./VendorsModal.vue";

const page = usePage();
const props = defineProps({});

const showCart = ref(false);
const showMobileNav = ref(false);
const cartButtonRef = ref(null);
const cartDropdownRef = ref(null);

// Get cartItems from Inertia props
const cartItems = computed(() => page.props.value?.cartItems || []);
const events = page.props.events;
const isVendor = page.props.auth.isVendor;
const authed = Boolean(page.props.auth.user);

const showVendorModal = ref(false);
const currentStep = ref(1);
const selectedPlan = ref("premium");
const paymentMethod = ref("card");

const registrationSteps = ["Choose Plan", "Business Info", "Payment"];

const openVendorRegistration = () => {
    if (authed) {
        showVendorModal.value = true;
        currentStep.value = 1;
    } else {
        window.location.href = `/login?intended_action=open_vendor_modal`;
    }
};

const closeVendorModal = () => {
    showVendorModal.value = false;
    currentStep.value = 1;
    selectedPlan.value = "premium";
    businessInfo.value = {
        name: "",
        category: "",
        description: "",
        email: "",
        phone: "",
        address: "",
    };
};

const businessInfo = ref({
    name: "",
    category: "",
    description: "",
    email: "",
    phone: "",
    address: "",
});

const toggleCart = () => {
    showCart.value = !showCart.value;
};

const handleClickOutside = (event) => {
    if (
        cartButtonRef.value &&
        cartDropdownRef.value &&
        !cartButtonRef.value.contains(event.target) &&
        !cartDropdownRef.value.contains(event.target)
    ) {
        showCart.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);

    const params = new URLSearchParams(window.location.search);
    const action = params.get("intended_action");

    if (action === "open_vendor_modal") {
        showVendorModal.value = true;
        currentStep.value = 1;
    }
});
</script>
