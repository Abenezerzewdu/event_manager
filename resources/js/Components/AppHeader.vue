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

                <!-- Navigation -->
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

                    <!-- events dropdow -->
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
                    <button
                        @click="openVendorRegistration"
                        class="hidden px-3 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 lg:block"
                    >
                        Become Vendor
                    </button>

                    <button
                        class="hidden text-gray-700 transition-colors hover:text-hati-pink md:block"
                    >
                        <!-- make this based on the role of the user -->
                        <Link v-if="authed" href="dashboard">Dashboard </Link>
                    </button>

                    <button
                        class="px-3 py-2 text-sm text-white transition-colors rounded-lg md:px-4 md:py-2 bg-hati-pink hover:bg-pink-600 md:text-base"
                    >
                        Enter
                    </button>

                    <!-- Cart -->
                    <div class="relative">
                        <button
                            @click="toggleCart"
                            data-cart-button
                            class="relative p-2 text-gray-700 transition-colors hover:text-hati-pink"
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

                        <!-- Cart Dropdown -->
                        <div
                            v-if="showCart"
                            data-cart-dropdown
                            class="absolute right-0 z-50 mt-2 bg-white border border-gray-100 shadow-lg top-full w-80 rounded-xl"
                        >
                            <div class="p-4 border-b border-gray-100">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold">
                                        Your Basket ({{ cartItems.length }})
                                    </h3>
                                    <button
                                        @click="toggleCart"
                                        class="text-gray-400 hover:text-gray-600"
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
                                                d="M6 18L18 6M6 6l12 12"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
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
                                        <div
                                            class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded"
                                        >
                                            <svg
                                                class="w-5 h-5 text-blue-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-3m-9 0h3m0 0h2m-6 0v-4a2 2 0 011-1h3a2 2 0 011 1v4M9 9h6"
                                                ></path>
                                            </svg>
                                        </div>

                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium">
                                                {{ item.name }}
                                            </h4>
                                            <p
                                                class="text-sm font-bold text-hati-pink"
                                            >
                                                {{ item.price }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <div
                                            class="flex items-center justify-between mb-3"
                                        >
                                            <span
                                                class="font-bold text-hati-pink"
                                                >90.000.000</span
                                            >
                                            <button
                                                class="text-sm text-gray-600 hover:text-gray-800"
                                            >
                                                View Detail
                                            </button>
                                        </div>

                                        <button
                                            class="w-full py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700"
                                        >
                                            Your Basket ({{ cartItems.length }})
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="p-2 md:hidden">
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
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import VendorsModal from "./VendorsModal.vue";
const page = usePage();
const props = defineProps({});
const showCart = ref(false);

//eventtype props from appserviceprovider shared globally
const events = page.props.events;

//loggedin user only can apply for vendorship
const authed = Boolean(page.props.auth.user);
//console.log(authed);

// Vendor registration state
const showVendorModal = ref(false);
const currentStep = ref(1);
const selectedPlan = ref("premium");
const paymentMethod = ref("card");

const registrationSteps = ["Choose Plan", "Business Info", "Payment"];

// Vendor registration methods
const openVendorRegistration = () => {
    //check for user is loggedin/registered
    if (authed) {
        showVendorModal.value = true;
        currentStep.value = 1;
    } else {
        // localStorage.setItem("postLoginIntent", pricing);
        window.location.href = `/login?intended_action=open_vendor_modal`;
    }
};
onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const action = params.get("intended_action");

    if (action === "open_vendor_modal") {
        showVendorModal.value = true;
        currentStep.value = 1;
    }
});

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

const cartItems = ref([
    {
        id: 1,
        name: "service-vendor",
        price: "10.000.000 br",
    },
    {
        id: 2,
        name: "service-vendor",
        price: "6000.00 br",
    },
    {
        id: 3,
        name: "service - vendor",
        price: "25999 br",
    },
    {
        id: 4,
        name: "service - vendor",
        price: "5000 br",
    },
]);

const toggleCart = () => {
    showCart.value = !showCart.value;
};

// Close cart when clicking outside
document.addEventListener("click", (e) => {
    const cartButton = e.target?.closest("[data-cart-button]");
    const cartDropdown = e.target?.closest("[data-cart-dropdown]");

    if (!cartButton && !cartDropdown) {
        showCart.value = false;
    }
});
</script>
