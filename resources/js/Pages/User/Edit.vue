<template>
  <div class="p-6">
    <h1>{{ message }}</h1>

    <form @submit.prevent="submitForm" class="max-w-md mx-auto mt-6">
      <div class="mb-4">
        <label>Name:</label>
        <input v-model="form.name" type="text" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Email:</label>
        <input v-model="form.email" type="email" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Password (leave blank to keep current):</label>
        <input v-model="form.password" type="password" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Confirm Password:</label>
        <input v-model="form.password_confirmation" type="password" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Phone:</label>
        <input v-model="form.phone" type="text" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Role:</label>
        <input v-model="form.role" type="text" class="border p-2 w-full"/>
      </div>

      <div class="mb-4">
        <label>Admin:</label>
        <input type="checkbox" v-model="form.is_admin" class="mr-2"/> Yes
      </div>

      <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded" :disabled="form.processing">
        <span v-if="form.processing">Updating...</span>
        <span v-else>Update</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  user: Object,
  message: String
});

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  password: '',
  password_confirmation: '',
  phone: props.user.phone,
  is_admin: props.user.is_admin,
  role: props.user.role
});


function submitForm() {
  form.put(route('user.update', props.user.id));
}

</script>
