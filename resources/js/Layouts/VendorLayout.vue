<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="flex flex-col w-64 bg-white shadow-md">
      <div class="p-4 text-xl font-bold border-b">Vendor Panel</div>
      <nav class="flex-1 p-4 space-y-2">
        <Link
          href="/vendor/dashboard"
          class="block px-4 py-2 rounded hover:bg-gray-200"
          :class="{ 'bg-gray-200 font-semibold': $page.url.startsWith('/vendor/dashboard') }"
        >
          Dashboard
        </Link>
        <Link
          href="/vendor/products"
          class="block px-4 py-2 rounded hover:bg-gray-200"
          :class="{ 'bg-gray-200 font-semibold': $page.url.startsWith('/vendor/products') }"
        >
          Products
        </Link>
        <Link
          href="/vendor/orders"
          class="block px-4 py-2 rounded hover:bg-gray-200"
          :class="{ 'bg-gray-200 font-semibold': $page.url.startsWith('/vendor/orders') }"
        >
          Orders
        </Link>
        <Link
          href="/vendor/profile"
          class="block px-4 py-2 rounded hover:bg-gray-200"
          :class="{ 'bg-gray-200 font-semibold': $page.url.startsWith('/vendor/profile') }"
        >
          Profile
        </Link>
      </nav>
      <div class="p-4 border-t">
        <form method="POST" action="/logout">
          <button class="w-full px-4 py-2 text-left text-red-600 rounded hover:bg-red-100">Logout</button>
        </form>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
      <header class="p-4 bg-white shadow">
        <h1 class="text-xl font-semibold">{{ title }}</h1>
      </header>
      <section class="p-6">
        <slot />
      </section>
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  title: {
    type: String,
    default: 'Vendor Dashboard'
  }
})
</script>
