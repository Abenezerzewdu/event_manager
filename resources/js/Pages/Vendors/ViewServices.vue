<template>
    <VendorLayout>
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Select services your company can provide
            </h2>

            <div
                v-if="$page.props.flash.success"
                class="mb-4 p-3 rounded-lg bg-green-100 text-green-800"
            >
                {{ $page.props.flash.success }}
            </div>

            <form @submit.prevent="handleSave" class="space-y-4">
                <div
                    v-for="service in services"
                    :key="service.id"
                    class="flex items-start space-x-3 p-3 border rounded-lg hover:bg-gray-50"
                >
                    <input
                        type="checkbox"
                        :value="service.id"
                        v-model="selectedServices"
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    />
                    <div>
                        <p class="font-medium text-gray-700">
                            {{ service.name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ service.description }}
                        </p>
                    </div>
                </div>

                <PrimaryButton
                    type="submit"
                    :disabled="form.processing"
                    class="mt-6 w-full"
                >
                    Save
                </PrimaryButton>
            </form>
        </div>
    </VendorLayout>
</template>

<script setup>
import { defineProps, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import VendorLayout from "@/Layouts/VendorLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    services: Array,
});

// Track selected services
const selectedServices = ref([]);

// Inertia form
const form = useForm({
    services: [],
});

function handleSave() {
    form.services = selectedServices.value;
    form.post(route("vendor.services.update"), {
        preserveScroll: true,
    });
}
</script>
