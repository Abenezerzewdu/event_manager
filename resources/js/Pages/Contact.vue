<template>
    <AppHeader />
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto">
                    <h1
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                    >
                        Get in Touch
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Ready to plan your dream wedding? Let's make your
                        special day unforgettable. Contact us today and let's
                        start planning together.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Form & Info Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                    <!-- Contact Form -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Send us a Message
                        </h2>

                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        for="firstName"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        First Name *
                                    </label>
                                    <input
                                        id="firstName"
                                        v-model="form.firstName"
                                        type="text"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                        placeholder="Enter your first name"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="lastName"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Last Name *
                                    </label>
                                    <input
                                        id="lastName"
                                        v-model="form.lastName"
                                        type="text"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                        placeholder="Enter your last name"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Email Address *
                                </label>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Enter your email address"
                                />
                            </div>

                            <div>
                                <label
                                    for="phone"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Phone Number
                                </label>
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Enter your phone number"
                                />
                            </div>

                            <div>
                                <label
                                    for="weddingDate"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Wedding Date
                                </label>
                                <input
                                    id="weddingDate"
                                    v-model="form.weddingDate"
                                    type="date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                />
                            </div>

                            <div>
                                <label
                                    for="service"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Service Interested In
                                </label>
                                <select
                                    id="service"
                                    v-model="form.service"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                >
                                    <option value="">Select a service</option>
                                    <option value="venue">Venue Booking</option>
                                    <option value="catering">Catering</option>
                                    <option value="photography">
                                        Photography
                                    </option>
                                    <option value="decoration">
                                        Decoration
                                    </option>
                                    <option value="music">
                                        Music & Entertainment
                                    </option>
                                    <option value="dresses">
                                        Wedding Dresses
                                    </option>
                                    <option value="planning">
                                        Full Wedding Planning
                                    </option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    for="message"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Message *
                                </label>
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    required
                                    rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hati-pink focus:border-transparent"
                                    placeholder="Tell us about your dream wedding..."
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-full bg-hati-pink text-white py-3 px-6 rounded-lg font-medium hover:bg-pink-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span v-if="!isSubmitting">Send Message</span>
                                <span
                                    v-else
                                    class="flex items-center justify-center"
                                >
                                    <svg
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <!-- Contact Details -->
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                Contact Information
                            </h2>

                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-hati-pink bg-opacity-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                    >
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
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-semibold text-gray-900 mb-1"
                                        >
                                            Address
                                        </h3>
                                        <p class="text-gray-600">
                                            Jl. Kebon Jeruk Raya No. 27<br />
                                            Jakarta Barat 11530<br />
                                            Indonesia
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-hati-pink bg-opacity-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                    >
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
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-semibold text-gray-900 mb-1"
                                        >
                                            Phone
                                        </h3>
                                        <p class="text-gray-600">
                                            +62 21 5696 7890<br />
                                            +62 812 3456 7890
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-hati-pink bg-opacity-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                    >
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
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-semibold text-gray-900 mb-1"
                                        >
                                            Email
                                        </h3>
                                        <p class="text-gray-600">
                                            hello@hati.wedding<br />
                                            info@hati.wedding
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-hati-pink bg-opacity-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                    >
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
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-semibold text-gray-900 mb-1"
                                        >
                                            Business Hours
                                        </h3>
                                        <p class="text-gray-600">
                                            Monday - Friday: 9:00 AM - 6:00
                                            PM<br />
                                            Saturday: 10:00 AM - 4:00 PM<br />
                                            Sunday: By appointment only
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                Follow Us
                            </h2>

                            <div class="flex space-x-4">
                                <a
                                    href="#"
                                    class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
                                        />
                                    </svg>
                                </a>

                                <a
                                    href="#"
                                    class="w-12 h-12 bg-blue-500 text-white rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                                        />
                                    </svg>
                                </a>

                                <a
                                    href="#"
                                    class="w-12 h-12 bg-pink-500 text-white rounded-lg flex items-center justify-center hover:bg-pink-600 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.219-.359-1.219c0-1.142.662-1.995 1.488-1.995.219 0 .979.219.979 1.488 0 .905-.578 2.262-.905 3.513-.259 1.077.538 1.952 1.602 1.952 1.92 0 3.39-2.024 3.39-4.947 0-2.588-1.86-4.394-4.516-4.394-3.077 0-4.877 2.307-4.877 4.69 0 .929.357 1.929.802 2.47.088.107.101.201.074.311-.08.33-.256 1.006-.292 1.148-.048.183-.157.222-.362.134-1.351-.629-2.197-2.607-2.197-4.193 0-3.403 2.472-6.527 7.124-6.527 3.739 0 6.641 2.664 6.641 6.22 0 3.717-2.342 6.704-5.594 6.704-1.093 0-2.123-.568-2.474-1.317l-.673 2.568c-.243.94-.901 2.12-1.34 2.838C9.83 23.81 10.892 24.029 12.017 24.029c6.624 0 11.99-5.367 11.99-11.986C24.007 5.367 18.641.001 12.017.001z"
                                        />
                                    </svg>
                                </a>

                                <a
                                    href="#"
                                    class="w-12 h-12 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"
                                        />
                                    </svg>
                                </a>
                            </div>

                            <p class="text-gray-600 mt-4 text-sm">
                                Stay connected with us for the latest wedding
                                trends, inspiration, and special offers!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Message -->
        <div
            v-if="showSuccess"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click="showSuccess = false"
        >
            <div class="bg-white rounded-xl p-8 max-w-md mx-4 text-center">
                <div
                    class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <svg
                        class="w-8 h-8 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        ></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">
                    Message Sent!
                </h3>
                <p class="text-gray-600 mb-6">
                    Thank you for reaching out! We'll get back to you within 24
                    hours.
                </p>
                <button
                    @click="showSuccess = false"
                    class="bg-hati-pink text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition-colors"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppHeader from "@/Components/AppHeader.vue";
import { ref } from "vue";

const isSubmitting = ref(false);
const showSuccess = ref(false);

const form = ref({
    firstName: "",
    lastName: "",
    email: "",
    phone: "",
    weddingDate: "",
    service: "",
    message: "",
});

const submitForm = async () => {
    isSubmitting.value = true;

    try {
        // Simulate form submission (fake API delay)
        await new Promise((resolve) => setTimeout(resolve, 1500));

        // Reset form
        form.value = {
            firstName: "",
            lastName: "",
            email: "",
            phone: "",
            weddingDate: "",
            service: "",
            message: "",
        };

        showSuccess.value = true;
    } catch (error) {
        console.error("Error submitting form:", error);
    } finally {
        isSubmitting.value = false;
    }
};
</script>
