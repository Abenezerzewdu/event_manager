<template>
    <VendorLayout>
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Update Profile
            </h2>

            <div
                v-if="$page.props.flash.success"
                class="mb-4 p-3 rounded-lg bg-green-100 text-green-800"
            >
                {{ $page.props.flash.success }}
            </div>

            <form
                @submit.prevent="handleSave"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                <!-- Company Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Company Name</label
                    >
                    <input
                        v-model="form.company_name"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Contact Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Contact Email</label
                    >
                    <input
                        v-model="form.contact_email"
                        type="email"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Phone</label
                    >
                    <input
                        v-model="form.phone"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Address</label
                    >
                    <input
                        v-model="form.address"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <textarea
                        v-model="form.description"
                        rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    ></textarea>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Upload File</label
                    >
                    <input
                        type="file"
                        @change="handleFileChange"
                        class="mt-1 block w-full text-gray-600 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                    <p
                        v-if="vendorFilePreview"
                        class="mt-2 text-sm text-gray-500"
                    >
                        Current File:
                        <a
                            :href="vendorFilePreview"
                            target="_blank"
                            class="text-blue-600 underline"
                            >View</a
                        >
                    </p>
                </div>

                <!-- Save Button -->
                <PrimaryButton
                    type="submit"
                    :disabled="form.processing"
                    class="w-full"
                >
                    Update Profile
                </PrimaryButton>
            </form>
        </div>
    </VendorLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import VendorLayout from "@/Layouts/VendorLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { defineProps, ref } from "vue";

const props = defineProps({
    vendor: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    company_name: props.vendor.company_name || "",
    contact_email: props.vendor.contact_email || "",
    phone: props.vendor.phone || "",
    address: props.vendor.address || "",
    description: props.vendor.description || "",
    vendors_file: null,
});

const vendorFilePreview = props.vendor.vendors_file
    ? `/storage/${props.vendor.vendors_file}`
    : null;

function handleFileChange(e) {
    form.vendors_file = e.target.files[0];
}

function handleSave() {
    form.post(route("vendor.profile.update"), {
        forceFormData: true, // important for file upload
    });
}
</script>
