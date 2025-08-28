<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Users</h1>
    <p>{{ message }}</p>

    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="border p-2">Name</th>
          <th class="border p-2">Email</th>
          <th class="border p-2">Role</th>
          <th class="border p-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" class="border-b">
          <td class="border p-2">{{ user.name }}</td>
          <td class="border p-2">{{ user.email }}</td>
          <td class="border p-2">{{ user.role || 'N/A' }}</td>
          <td class="border p-2">
            <Link :href="route('user.show', user.id)" class="text-blue-500 mr-2">View</Link>
            <Link :href="route('user.edit', user.id)" class="text-yellow-500 mr-2">Edit</Link>
            <button @click="destroy(user.id)" class="text-red-500">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <Link href="/user/create" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Add User</Link>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/vue3';
defineProps({
  message: String,
  users: Array
});

function destroy(id) {
  if (confirm('Are you sure you want to delete this user?')) {
    Inertia.delete(route('user.destroy', id));
  }
}
</script>
