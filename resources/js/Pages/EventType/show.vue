<template>
    <div class="p-6">
        <h1>Event Type Details</h1>

        <div
            v-if="page.props.flash.success"
            class="bg-green-200 p-2 mb-4 rounded"
        >
            {{ page.props.flash.success }}
        </div>

        <p><strong>ID:</strong> {{ eventType.id }}</p>
        <p><strong>Name:</strong> {{ eventType.name }}</p>
        <p><strong>Category:</strong> {{ eventType.category }}</p>
        <p><strong>Created At:</strong> {{ eventType.created_at }}</p>
    </div>
</template>

<script setup>

const props = defineProps({
    eventType: Object
})
</script>
