<template>
  <div class="p-6">
    <h1>{{ message }}</h1>

    <form @submit.prevent="submitForm" class="max-w-md mx-auto mt-6">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Email:</label>
        <input v-model="form.email" type="email" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Password:</label>
        <input v-model="form.password" type="password" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Confirm Password:</label>
        <input v-model="form.password_confirmation" type="password" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Phone:</label>
        <input v-model="form.phone" type="text" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Role:</label>
        <input v-model="form.role" type="text" class="w-full p-2 border"/>
      </div>

      <div class="mb-4">
        <label>Admin:</label>
        <input type="checkbox" v-model="form.is_admin" class="mr-2"/> Yes
      </div>

      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded" :disabled="form.processing">
        <span v-if="form.processing">Submitting...</span>
        <span v-else>Submit</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  message: {
    type: String,
    default: "Edit User",
  },
  errors: Object,
});

const form = useForm({
  _method: "put",
  name: props.user.name || "",
  email: props.user.email || "",
  password: "",
  password_confirmation: "",
  phone: props.user.phone || "",
  is_admin: props.user.is_admin || false,
  role: props.user.role || "",
});

const submitForm = () => {
  // Explicitly set the URL to ensure it targets the update route
  form.put(`/user/${props.user.id}`, {
    // Preserve the current page's data and method spoofing
    preserveScroll: true,
    onError: (errors) => {
      console.log("Validation errors:", errors);
      form.setError(errors);
    },
    onSuccess: () => {
      console.log("User updated successfully");
      // Optionally redirect to the index page
      // form.visit(route('user.index'));
    },
  });
};
</script>
