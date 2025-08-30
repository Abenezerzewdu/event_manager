<template>
    <header class="bg-white border-b border-gray-100 shadow-sm">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <Link to="/" class="flex items-center space-x-2 group">
                    <!-- Heart Icon -->
                    <!-- <div class="relative">
                        <div
                            class="flex items-center justify-center w-10 h-10 transition-all duration-300 rounded-full shadow-md bg-gradient-to-br from-hati-pink to-pink-600 group-hover:shadow-lg group-hover:scale-105"
                        >
                           
                        </div>
                    </div> -->
                    <!-- logo Text -->
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
                            <span>placeholder</span>
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
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    >Catering</a
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

                    <Link
                        to="/venue"
                        class="text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Venue
                    </Link>

                    <Link
                        to="/vendors"
                        class="text-gray-700 transition-colors hover:text-hati-pink"
                    >
                        Vendors
                    </Link>

                    <Link
                        to="/contact"
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
                        Register as Vendor
                    </button>

                    <button
                        class="hidden text-gray-700 transition-colors hover:text-hati-pink md:block"
                    >
                        Daftar
                    </button>

                    <button
                        class="px-3 py-2 text-sm text-white transition-colors rounded-lg md:px-4 md:py-2 bg-hati-pink hover:bg-pink-600 md:text-base"
                    >
                        Masuk
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
                                                >Rp90.000.000</span
                                            >
                                            <button
                                                class="text-sm text-gray-600 hover:text-gray-800"
                                            >
                                                Lihat Detail
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
            </div>
        </div>

        <!-- Vendor Registration Modal -->
        <div
            v-if="showVendorModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            @click="closeVendorModal"
        >
            <div
                class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <!-- Modal Header -->
                <div
                    class="p-6 text-white bg-gradient-to-r from-hati-pink to-pink-600 rounded-t-2xl"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="mb-2 text-3xl font-bold">
                                Become a Vendor Partner
                            </h2>
                            <p class="text-pink-100">
                                Join our platform and grow your wedding business
                            </p>
                        </div>
                        <button
                            @click="closeVendorModal"
                            class="flex items-center justify-center w-8 h-8 transition-colors rounded-full bg-white/20 hover:bg-white/30"
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

                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Step Indicator -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="flex items-center space-x-4">
                            <div
                                v-for="(step, index) in registrationSteps"
                                :key="step"
                                class="flex items-center"
                            >
                                <div
                                    :class="[
                                        'w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold',
                                        currentStep >= index + 1
                                            ? 'bg-hati-pink text-white'
                                            : 'bg-gray-200 text-gray-500',
                                    ]"
                                >
                                    {{ index + 1 }}
                                </div>
                                <span
                                    :class="[
                                        'ml-2 text-sm font-medium',
                                        currentStep >= index + 1
                                            ? 'text-hati-pink'
                                            : 'text-gray-500',
                                    ]"
                                    >{{ step }}</span
                                >
                                <div
                                    v-if="index < registrationSteps.length - 1"
                                    :class="[
                                        'w-8 h-px ml-4',
                                        currentStep > index + 1
                                            ? 'bg-hati-pink'
                                            : 'bg-gray-200',
                                    ]"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step Content -->
                    <div v-if="currentStep === 1" class="space-y-6">
                        <div class="mb-8 text-center">
                            <h3 class="mb-4 text-2xl font-bold text-gray-900">
                                Choose Your Plan
                            </h3>
                            <p class="text-gray-600">
                                Select the perfect plan for your business needs
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-3">
                            <!-- Basic Plan -->
                            <div
                                :class="[
                                    'border-2 rounded-xl p-6 cursor-pointer transition-all hover:shadow-lg',
                                    selectedPlan === 'basic'
                                        ? 'border-hati-pink bg-pink-50'
                                        : 'border-gray-200',
                                ]"
                                @click="selectPlan('basic')"
                            >
                                <div class="text-center">
                                    <h4
                                        class="mb-2 text-xl font-bold text-gray-900"
                                    >
                                        Basic
                                    </h4>
                                    <div
                                        class="mb-4 text-3xl font-bold text-hati-pink"
                                    >
                                        Rp 500K<span
                                            class="text-lg text-gray-500"
                                            >/month</span
                                        >
                                    </div>
                                    <ul
                                        class="mb-6 space-y-2 text-sm text-left text-gray-600"
                                    >
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Profile listing
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Contact inquiries
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Basic analytics
                                        </li>
                                    </ul>
                                    <div
                                        :class="[
                                            'w-full py-2 px-4 rounded-lg font-medium transition-colors',
                                            selectedPlan === 'basic'
                                                ? 'bg-hati-pink text-white'
                                                : 'bg-gray-100 text-gray-700',
                                        ]"
                                    >
                                        {{
                                            selectedPlan === "basic"
                                                ? "Selected"
                                                : "Select Plan"
                                        }}
                                    </div>
                                </div>
                            </div>

                            <!-- Premium Plan -->
                            <div
                                :class="[
                                    'border-2 rounded-xl p-6 cursor-pointer transition-all hover:shadow-lg relative',
                                    selectedPlan === 'premium'
                                        ? 'border-hati-pink bg-pink-50'
                                        : 'border-gray-200',
                                ]"
                                @click="selectPlan('premium')"
                            >
                                <div
                                    class="absolute transform -translate-x-1/2 -top-3 left-1/2"
                                >
                                    <span
                                        class="px-3 py-1 text-xs font-medium text-white rounded-full bg-hati-pink"
                                        >Most Popular</span
                                    >
                                </div>
                                <div class="text-center">
                                    <h4
                                        class="mb-2 text-xl font-bold text-gray-900"
                                    >
                                        Premium
                                    </h4>
                                    <div
                                        class="mb-4 text-3xl font-bold text-hati-pink"
                                    >
                                        Rp 1.2M<span
                                            class="text-lg text-gray-500"
                                            >/month</span
                                        >
                                    </div>
                                    <ul
                                        class="mb-6 space-y-2 text-sm text-left text-gray-600"
                                    >
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Featured listing
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Priority support
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Advanced analytics
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Portfolio gallery
                                        </li>
                                    </ul>
                                    <div
                                        :class="[
                                            'w-full py-2 px-4 rounded-lg font-medium transition-colors',
                                            selectedPlan === 'premium'
                                                ? 'bg-hati-pink text-white'
                                                : 'bg-gray-100 text-gray-700',
                                        ]"
                                    >
                                        {{
                                            selectedPlan === "premium"
                                                ? "Selected"
                                                : "Select Plan"
                                        }}
                                    </div>
                                </div>
                            </div>

                            <!-- Elite Plan -->
                            <div
                                :class="[
                                    'border-2 rounded-xl p-6 cursor-pointer transition-all hover:shadow-lg',
                                    selectedPlan === 'elite'
                                        ? 'border-hati-pink bg-pink-50'
                                        : 'border-gray-200',
                                ]"
                                @click="selectPlan('elite')"
                            >
                                <div class="text-center">
                                    <h4
                                        class="mb-2 text-xl font-bold text-gray-900"
                                    >
                                        Elite
                                    </h4>
                                    <div
                                        class="mb-4 text-3xl font-bold text-hati-pink"
                                    >
                                        Rp 2.5M<span
                                            class="text-lg text-gray-500"
                                            >/month</span
                                        >
                                    </div>
                                    <ul
                                        class="mb-6 space-y-2 text-sm text-left text-gray-600"
                                    >
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Top placement
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Dedicated manager
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Custom branding
                                        </li>
                                        <li class="flex items-center">
                                            <svg
                                                class="w-4 h-4 mr-2 text-green-500"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            >Marketing support
                                        </li>
                                    </ul>
                                    <div
                                        :class="[
                                            'w-full py-2 px-4 rounded-lg font-medium transition-colors',
                                            selectedPlan === 'elite'
                                                ? 'bg-hati-pink text-white'
                                                : 'bg-gray-100 text-gray-700',
                                        ]"
                                    >
                                        {{
                                            selectedPlan === "elite"
                                                ? "Selected"
                                                : "Select Plan"
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Business Information -->
                    <div v-if="currentStep === 2" class="space-y-6">
                        <div class="mb-8 text-center">
                            <h3 class="mb-4 text-2xl font-bold text-gray-900">
                                Business Information
                            </h3>
                            <p class="text-gray-600">
                                Tell us about your wedding business
                            </p>
                        </div>

                        <form class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Business Name *</label
                                >
                                <input
                                    v-model="businessInfo.name"
                                    type="text"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Enter your business name"
                                />
                            </div>

                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Business Category *</label
                                >
                                <select
                                    v-model="businessInfo.category"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                >
                                    <option value="">Select category</option>
                                    <option value="photography">
                                        Photography
                                    </option>
                                    <option value="catering">Catering</option>
                                    <option value="venue">Venue</option>
                                    <option value="decoration">
                                        Decoration
                                    </option>
                                    <option value="music">
                                        Music & Entertainment
                                    </option>
                                    <option value="beauty">
                                        Beauty & Makeup
                                    </option>
                                    <option value="dresses">
                                        Wedding Dresses
                                    </option>
                                    <option value="transportation">
                                        Transportation
                                    </option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Business Description *</label
                                >
                                <textarea
                                    v-model="businessInfo.description"
                                    required
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Describe your business and services"
                                ></textarea>
                            </div>

                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Contact Email *</label
                                >
                                <input
                                    v-model="businessInfo.email"
                                    type="email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="business@example.com"
                                />
                            </div>

                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Phone Number *</label
                                >
                                <input
                                    v-model="businessInfo.phone"
                                    type="tel"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="+62 812 3456 7890"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Business Address *</label
                                >
                                <input
                                    v-model="businessInfo.address"
                                    type="text"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Full business address"
                                />
                            </div>
                        </form>
                    </div>

                    <!-- Step 3: Payment -->
                    <div v-if="currentStep === 3" class="space-y-6">
                        <div class="mb-8 text-center">
                            <h3 class="mb-4 text-2xl font-bold text-gray-900">
                                Payment Information
                            </h3>
                            <p class="text-gray-600">
                                Complete your registration with secure payment
                            </p>
                        </div>

                        <!-- Order Summary -->
                        <div class="p-6 mb-6 bg-gray-50 rounded-xl">
                            <h4 class="mb-4 font-bold text-gray-900">
                                Order Summary
                            </h4>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-600"
                                    >{{
                                        selectedPlan.charAt(0).toUpperCase() +
                                        selectedPlan.slice(1)
                                    }}
                                    Plan</span
                                >
                                <span class="font-bold">{{
                                    getPlanPrice(selectedPlan)
                                }}</span>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-600">Setup Fee</span>
                                <span class="font-bold">Rp 250.000</span>
                            </div>
                            <div class="pt-4 border-t">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold">Total</span>
                                    <span
                                        class="text-xl font-bold text-hati-pink"
                                        >{{ getTotalPrice() }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="grid gap-4 md:grid-cols-2">
                            <div
                                :class="[
                                    'border-2 rounded-lg p-4 cursor-pointer transition-colors',
                                    paymentMethod === 'card'
                                        ? 'border-hati-pink bg-pink-50'
                                        : 'border-gray-200',
                                ]"
                                @click="paymentMethod = 'card'"
                            >
                                <div class="flex items-center space-x-3">
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
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                        ></path>
                                    </svg>
                                    <span class="font-medium"
                                        >Credit/Debit Card</span
                                    >
                                </div>
                            </div>

                            <div
                                :class="[
                                    'border-2 rounded-lg p-4 cursor-pointer transition-colors',
                                    paymentMethod === 'bank'
                                        ? 'border-hati-pink bg-pink-50'
                                        : 'border-gray-200',
                                ]"
                                @click="paymentMethod = 'bank'"
                            >
                                <div class="flex items-center space-x-3">
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
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21v6H3V3h7.5z"
                                        ></path>
                                    </svg>
                                    <span class="font-medium"
                                        >Bank Transfer</span
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <div v-if="paymentMethod === 'card'" class="space-y-4">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-700"
                                    >Card Number</label
                                >
                                <input
                                    type="text"
                                    placeholder="1234 5678 9012 3456"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-700"
                                        >Expiry Date</label
                                    >
                                    <input
                                        type="text"
                                        placeholder="MM/YY"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-700"
                                        >CVV</label
                                    >
                                    <input
                                        type="text"
                                        placeholder="123"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            v-if="paymentMethod === 'bank'"
                            class="p-6 rounded-lg bg-blue-50"
                        >
                            <h4 class="mb-4 font-bold text-blue-900">
                                Bank Transfer Instructions
                            </h4>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Bank:</span>
                                    <span class="font-medium"
                                        >Bank Central Asia (BCA)</span
                                    >
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700"
                                        >Account Number:</span
                                    >
                                    <span class="font-medium">1234567890</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700"
                                        >Account Name:</span
                                    >
                                    <span class="font-medium"
                                        >PT Joy Wedding Services</span
                                    >
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Amount:</span>
                                    <span class="text-lg font-medium">{{
                                        getTotalPrice()
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div
                        class="flex items-center justify-between pt-6 border-t"
                    >
                        <button
                            v-if="currentStep > 1"
                            @click="previousStep"
                            class="px-6 py-3 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50"
                        >
                            Previous
                        </button>
                        <div v-else></div>

                        <button
                            v-if="currentStep < 3"
                            @click="nextStep"
                            :disabled="!canProceed"
                            :class="[
                                'px-6 py-3 rounded-lg font-medium transition-colors',
                                canProceed
                                    ? 'bg-hati-pink text-white hover:bg-pink-600'
                                    : 'bg-gray-200 text-gray-500 cursor-not-allowed',
                            ]"
                        >
                            Next Step
                        </button>
                        <button
                            v-else
                            @click="completeRegistration"
                            class="px-6 py-3 font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700"
                        >
                            Complete Registration
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const showCart = ref(false);

// Vendor registration state
const showVendorModal = ref(false);
const currentStep = ref(1);
const selectedPlan = ref("premium");
const paymentMethod = ref("card");

const registrationSteps = ["Choose Plan", "Business Info", "Payment"];

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
        name: "Katering - Ibu Berliana",
        price: "Rp10.000.000",
    },
    {
        id: 2,
        name: "Website Design - Dlux Agency",
        price: "Rp5.000.000",
    },
    {
        id: 3,
        name: "Venue - Rumah Makan Liyu",
        price: "Rp25.000.000",
    },
    {
        id: 4,
        name: "WO - Mana Wedding",
        price: "Rp50.000.000",
    },
]);

const toggleCart = () => {
    showCart.value = !showCart.value;
};

// Vendor registration methods
const openVendorRegistration = () => {
    showVendorModal.value = true;
    currentStep.value = 1;
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

const selectPlan = (plan) => {
    selectedPlan.value = plan;
};

const nextStep = () => {
    if (canProceed.value && currentStep.value < 3) {
        currentStep.value++;
    }
};

const previousStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const getPlanPrice = (plan) => {
    const prices = {
        basic: "Rp 500.000",
        premium: "Rp 1.200.000",
        elite: "Rp 2.500.000",
    };
    return prices[plan] || "Rp 0";
};

const getTotalPrice = () => {
    const planPrices = {
        basic: 500000,
        premium: 1200000,
        elite: 2500000,
    };
    const setupFee = 250000;
    const total = (planPrices[selectedPlan.value] || 0) + setupFee;
    return `Rp ${total.toLocaleString("id-ID")}`;
};

const canProceed = computed(() => {
    if (currentStep.value === 1) {
        return selectedPlan.value !== "";
    }
    if (currentStep.value === 2) {
        return (
            businessInfo.value.name &&
            businessInfo.value.category &&
            businessInfo.value.description &&
            businessInfo.value.email &&
            businessInfo.value.phone &&
            businessInfo.value.address
        );
    }
    return true;
});

const completeRegistration = () => {
    // Handle registration completion
    alert(
        `Registration completed successfully! Welcome to Joy Wedding Services, ${businessInfo.value.name}!`
    );
    closeVendorModal();
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
