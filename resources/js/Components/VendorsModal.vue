<template>
    <!-- Vendor Registration Modal -->
    <div
        v-if="show"
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
                        <div class="mb-2 text-3xl font-bold text-black">
                            Become a Vendor Partner
                        </div>
                        <p class="text-100 text-black">
                            Join our platform and grow you business
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
                                    500 Br<span class="text-lg text-gray-500"
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
                                selectedPlan === 'premium',
                                // ? 'border-hati-pink bg-pink-50'
                                // : 'border-gray-200',
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
                                    1000 Br<span class="text-lg text-gray-500"
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
                                    1500 Br<span class="text-lg text-gray-500"
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
                                <option value="photography">Photography</option>
                                <option value="catering">Catering</option>
                                <option value="venue">Venue</option>
                                <option value="decoration">Decoration</option>
                                <option value="music">
                                    Music & Entertainment
                                </option>
                                <option value="beauty">Beauty & Makeup</option>
                                <option value="dresses">Wedding Dresses</option>
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
                                placeholder="0912341234"
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
                            <span class="font-bold"> 50.000 Br</span>
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
                                <span class="font-medium">Bank Transfer</span>
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
                                    >Commercial Bank Of Ethiopia (CBE)</span
                                >
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-700"
                                    >Account Number:</span
                                >
                                <span class="font-medium">1000567890</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-700">Account Name:</span>
                                <span class="font-medium">OJoy</span>
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
                <div class="flex items-center justify-between pt-6 border-t">
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
                                ? 'bg-hati-pink text-black hover:bg-pink-600'
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
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { onMounted } from "vue";

const page = usePage();
const props = defineProps({
    show: Boolean,
});

// logged-in user only can apply for vendorship
const authed = Boolean(page.props.auth.user);

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

onMounted(() => {
    const intent = localStorage.getItem("postLoginIntent");
    if (intent && authed) {
        showVendorModal.value = true;
        currentStep.value = 1;
        localStorage.removeItem("postLoginIntent");
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
        basic: " 500.000 Br",
        premium: "1000.000 Br",
        elite: "1500.000 Br",
    };
    return prices[plan] || " 0 Br";
};

const getTotalPrice = () => {
    const planPrices = {
        basic: 500,
        premium: 1000,
        elite: 1500,
    };
    const setupFee = 50;
    const total = (planPrices[selectedPlan.value] || 0) + setupFee;
    return ` ${total.toLocaleString("id-ID")} Br`;
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

function completeRegistration() {
    // Build the payload **inside the function** to get current values
    const payload = {
        user_id: page.props.auth.user.id, // logged-in user
        company_name: businessInfo.value.name,
        contact_email: businessInfo.value.email,
        phone: businessInfo.value.phone,
        address: businessInfo.value.address,
        description: businessInfo.value.description,
        plan: selectedPlan.value,
        payment_status: "unpaid", // default
        status: "pending", // default pending for admin approval
    };

    console.log("Payload before sending:", payload);

    router.post("/vendor/store", payload, {
        onSuccess: () => {
            closeVendorModal();
            alert("Vendor registration submitted successfully!");
        },
        onError: (errors) => {
            console.error("Validation failed:", errors);
        },
    });
}
</script>
