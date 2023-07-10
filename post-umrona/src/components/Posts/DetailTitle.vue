<script setup>
defineProps({
    detail: {
        type: String,
        required: true
    }
})
</script>

<template>
    <h1 class="font-bold text-lg mb-1">
        {{ detail }} :
    </h1>
</template>