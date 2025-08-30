<template>
  <div class="p-6">
    <h1>{{ message }}</h1>

    <form @submit.prevent="submitForm" class="max-w-md mx-auto mt-6">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Email:</label>
        <input v-model="form.email" type="email" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Password (leave blank to keep current):</label>
        <input v-model="form.password" type="password" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Confirm Password:</label>
        <input v-model="form.password_confirmation" type="password" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Phone:</label>
        <input v-model="form.phone" type="text" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Role:</label>
        <input v-model="form.role" type="text" class="w-full p-2 border" />
      </div>

      <div class="mb-4">
        <label>Admin:</label>
        <input type="checkbox" v-model="form.is_admin" class="mr-2" /> Yes
      </div>

      <button
        type="submit"
        class="px-4 py-2 text-white bg-yellow-500 rounded"
        :disabled="form.processing"
      >
        <span v-if="form.processing">Updating...</span>
        <span v-else>Update</span>
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
  form.put(route("user.update", { id: props.user.id }), {
    onError: (errors) => {
      console.log("Validation errors:", errors);
      // Optionally, you can set errors to be displayed in the form
      form.setError(errors);
    },
    onSuccess: () => {
      console.log("User updated successfully");
      // Redirect or refresh the page if needed
      // form.visit(route('user.index'));
    },
  });
};
</script>
