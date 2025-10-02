<script setup>
import { ref } from "vue";
import { MapPin, Mail, Phone } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    vendor: {
        type: Object,
        required: true,
    },
});

const vendor = props.vendor;
const showModal = ref(false);
const successMessage = ref("");

function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
}

const handleOrder = () => {
    const firstService = (vendor.services && vendor.services[0]) || null;

    if (!firstService) {
        alert("This vendor has no services available to order.");
        return;
    }

    router.post(
        route("orders.handle"),
        {
            vendor_id: vendor.id,
            service_id: firstService.id,
        },

        {
            preserveScroll: true,
            onSuccess: () => {
                // Show a custom success message
                successMessage.value = `You have successfully ordered "${firstService.name}" from ${vendor.company_name}. The vendor will contact you soon.`;

                setTimeout(() => {
                    successMessage.value = "";
                }, 5000);
            },
            onError: () => {
                alert("Something went wrong. Please try again.");
            },
        }
    );
};
</script>

<template>
    <!-- Card -->
    <div class="p-4">
        <div
            @click="openModal"
            class="cursor-pointer max-w-sm mx-auto rounded-xl shadow-lg overflow-hidden transform transition hover:scale-105 hover:shadow-2xl bg-gradient-to-br from-indigo-50 via-white to-purple-50"
        >
            <!-- Vendor Image -->
            <img
                v-if="vendor.vendors_file"
                :src="`/storage/${vendor.vendors_file}`"
                alt="Vendor Image"
                class="w-full h-48 object-cover rounded-t-xl"
            />
            <div
                v-else
                class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-xl"
            >
                <span class="text-gray-500">No Image</span>
            </div>

            <!-- Card Content -->
            <div class="p-5">
                <h2 class="text-xl font-bold text-gray-900 truncate">
                    {{ vendor.company_name }}
                </h2>

                <!-- Short Description -->
                <p class="text-gray-600 mt-1 text-sm line-clamp-3">
                    {{ vendor.description ?? "No description provided." }}
                </p>

                <!-- Service Tag -->
                <span
                    v-for="service in vendor.services"
                    :key="service.id"
                    class="px-3 py-1 text-xs font-semibold text-white bg-indigo-600 rounded-full"
                >
                    {{ service.name }}
                </span>

                <!-- Price -->
                <p class="mt-3 text-gray-800 font-medium">
                    Starting at:
                    <span class="text-green-600 font-bold"
                        >{{ vendor.starting_price ?? 0 }} Br</span
                    >
                </p>

                <!-- Address -->
                <div
                    v-if="vendor.address"
                    class="flex items-center gap-2 text-gray-700 text-sm mt-2"
                >
                    <MapPin class="w-4 h-4 text-indigo-600" />
                    <span class="truncate">{{ vendor.address }}</span>
                </div>

                <!-- Rating -->
                <div class="flex items-center mt-3">
                    <div class="flex">
                        <template v-for="i in 5" :key="i">
                            <svg
                                v-if="i <= Math.round(vendor.rating)"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-yellow-400"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.971a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.922-.755 1.688-1.54 1.118L10 13.347l-3.382 2.47c-.785.57-1.84-.196-1.54-1.118l1.285-3.97a1 1 0 00-.364-1.118L2.615 9.398c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.971z"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-gray-300"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.971a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.286 3.97c.3.922-.755 1.688-1.54 1.118L10 13.347l-3.382 2.47c-.785.57-1.84-.196-1.54-1.118l1.285-3.97a1 1 0 00-.364-1.118L2.615 9.398c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.971z"
                                />
                            </svg>
                        </template>
                    </div>
                    <span class="ml-2 text-gray-700 text-sm"
                        >{{ vendor.rating ?? 0 }}/5</span
                    >
                </div>

                <!-- CTA Button -->
                <button
                    @click.stop="handleOrder"
                    class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-lg transition"
                >
                    Order Now
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        v-if="showModal"
        class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        @click.self="closeModal"
    >
        <div
            v-if="successMessage"
            class="mt-4 p-3 text-sm text-green-800 bg-green-100 border border-green-300 rounded-lg shadow-sm"
        >
            {{ successMessage }}
        </div>
        <div
            class="bg-white rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 relative shadow-2xl"
            @click.stop
        >
            <!-- Close Button -->
            <button
                @click="closeModal"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl font-bold"
            >
                ✖
            </button>

            <!-- Vendor Image -->
            <img
                v-if="vendor.vendors_file"
                :src="`/storage/${vendor.vendors_file}`"
                alt="Vendor Image"
                class="w-full h-56 object-cover rounded-xl mb-5 shadow-md"
            />

            <h2 class="text-2xl font-bold mb-3 text-gray-900">
                {{ vendor.company_name }}
            </h2>

            <p class="text-gray-700 mb-4">
                {{ vendor.description ?? "No description available." }}
            </p>

            <div class="space-y-2 text-gray-700 text-sm">
                <div v-if="vendor.address" class="flex items-center gap-2">
                    <MapPin class="w-4 h-4 text-indigo-600" />
                    <span>{{ vendor.address }}</span>
                </div>
                <div v-if="vendor.email" class="flex items-center gap-2">
                    <Mail class="w-4 h-4 text-indigo-600" />
                    <span>{{ vendor.email }}</span>
                </div>
                <div v-if="vendor.phone" class="flex items-center gap-2">
                    <Phone class="w-4 h-4 text-indigo-600" />
                    <span>{{ vendor.phone }}</span>
                </div>
            </div>

            <span
                v-for="service in vendor.services"
                :key="service.id"
                class="px-3 py-1 text-xs font-semibold text-white bg-indigo-600 rounded-full"
            >
                {{ service.name }}
            </span>
            <p class="font-semibold text-green-600 mb-6">
                Starting at: {{ vendor.starting_price ?? 0 }} Br
            </p>

            <button
                @click="handleOrder"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition text-lg"
            >
                Order Now
            </button>
        </div>
    </div>
</template>
