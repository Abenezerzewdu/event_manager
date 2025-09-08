<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">{{ message }}</h1>

        <form
            @submit.prevent="submitForm"
            class="max-w-md mx-auto mt-6 space-y-4"
        >
            <!-- Name -->
            <div>
                <label class="block font-medium">Name:</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full p-2 border rounded"
                />
                <span v-if="form.errors.name" class="text-red-500 text-sm">
                    {{ form.errors.name }}
                </span>
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium">Email:</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full p-2 border rounded"
                />
                <span v-if="form.errors.email" class="text-red-500 text-sm">
                    {{ form.errors.email }}
                </span>
            </div>

            <!-- Password -->
            <div>
                <label class="block font-medium">Password:</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full p-2 border rounded"
                />
                <span v-if="form.errors.password" class="text-red-500 text-sm">
                    {{ form.errors.password }}
                </span>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block font-medium">Confirm Password:</label>
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    class="w-full p-2 border rounded"
                />
                <span
                    v-if="form.errors.password_confirmation"
                    class="text-red-500 text-sm"
                >
                    {{ form.errors.password_confirmation }}
                </span>
            </div>

            <!-- Phone -->
            <div>
                <label class="block font-medium">Phone:</label>
                <input
                    v-model="form.phone"
                    type="text"
                    class="w-full p-2 border rounded"
                />
                <span v-if="form.errors.phone" class="text-red-500 text-sm">
                    {{ form.errors.phone }}
                </span>
            </div>

            <!-- Role -->
            <div>
                <label class="block font-medium">Role:</label>
                <input
                    v-model="form.role"
                    type="text"
                    class="w-full p-2 border rounded"
                />
                <span v-if="form.errors.role" class="text-red-500 text-sm">
                    {{ form.errors.role }}
                </span>
            </div>

            <!-- Admin -->
            <div>
                <label class="block font-medium">Admin:</label>
                <input type="checkbox" v-model="form.is_admin" class="mr-2" />
                Yes
                <span v-if="form.errors.is_admin" class="text-red-500 text-sm">
                    {{ form.errors.is_admin }}
                </span>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="px-4 py-2 text-white bg-blue-500 rounded"
                :disabled="form.processing"
            >
                <span v-if="form.processing">Submitting...</span>
                <span v-else>Submit</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    message: {
        type: String,
        default: "Create User",
    },
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    phone: "",
    is_admin: false,
    role: "",
});

const submitForm = () => {
    form.post(route("user.store"), {
        onSuccess: () => {
            console.log("User created successfully");
        },
    });
};
</script>
