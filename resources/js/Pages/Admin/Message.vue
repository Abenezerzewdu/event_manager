<script setup>
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import CardBox from "@/Components/CardBox.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    vendors: Array,
});

// Modal state
const showModal = ref(false);
const selectedVendor = ref(null);

function openModal(vendor) {
    selectedVendor.value = vendor;
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    selectedVendor.value = null;
}

function approveVendor(id) {
    router.post(
        route("vendors.approve", id),
        {},
        {
            onSuccess: () => {
                closeModal();
            },
        }
    );
}

function rejectVendor(id) {
    router.post(
        route("vendors.reject", id),
        {},
        {
            onSuccess: () => {
                closeModal();
            },
        }
    );
}
</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <!-- Vendor Cards -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <CardBox
                    v-for="vendor in vendors"
                    :key="vendor.id"
                    class="cursor-pointer hover:shadow-lg transition"
                    @click="openModal(vendor)"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="font-bold text-lg text-gray-800">
                                {{ vendor.company_name }}
                            </h1>
                            <p class="text-gray-600 text-sm">
                                📞 {{ vendor.phone }}
                            </p>
                            <p class="text-gray-600 text-sm">
                                💳 {{ vendor.plan }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600 text-sm"
                                @click.stop="approveVendor(vendor.id)"
                            >
                                Approve
                            </button>
                            <button
                                class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 text-sm"
                                @click.stop="rejectVendor(vendor.id)"
                            >
                                Reject
                            </button>
                        </div>
                    </div>
                </CardBox>
            </div>

            <!-- Modal -->
            <div
                v-if="showModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative"
                >
                    <!-- Close button -->
                    <button
                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-800"
                        @click="closeModal"
                    >
                        ✖
                    </button>

                    <!-- Vendor Info -->
                    <h2
                        class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2"
                    >
                        {{ selectedVendor.company_name }}
                    </h2>

                    <div class="space-y-2 text-gray-700">
                        <p>
                            <strong>📞 Phone:</strong>
                            {{ selectedVendor.phone }}
                        </p>
                        <p>
                            <strong>💳 Plan:</strong> {{ selectedVendor.plan }}
                        </p>
                        <p>
                            <strong>📧 Email:</strong>
                            {{ selectedVendor.contact_email }}
                        </p>
                        <p>
                            <strong>📌 Status:</strong>
                            {{ selectedVendor.status }}
                        </p>
                        <p>
                            <strong>📝 Description:</strong><br />
                            <span class="block bg-gray-50 p-2 rounded text-sm">
                                {{ selectedVendor.description }}
                            </span>
                        </p>
                    </div>

                    <!-- Buttons inside modal -->
                    <div class="flex justify-end gap-3 mt-6">
                        <button
                            class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600"
                            @click="approveVendor(selectedVendor.id)"
                        >
                            ✅ Approve
                        </button>
                        <button
                            class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600"
                            @click="rejectVendor(selectedVendor.id)"
                        >
                            ❌ Reject
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400"
                            @click="closeModal"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </SectionMain>
    </LayoutAuthenticated>
</template>
