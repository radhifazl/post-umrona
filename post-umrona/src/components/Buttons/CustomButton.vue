<script setup>
defineProps({
    text: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'button'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    primary: {
        type: Boolean,
        default: false
    },
    customClasses: {
        type: String,
        default: ''
    },
    loading: {
        type: Boolean,
        default: false
    },
    isDelete: {
        type: Boolean,
        default: false
    },
})
</script>

<template>
  <button
    :type="type"
    :disabled="disabled"
    :class="[
      'px-4 py-2 rounded-md font-medium transition duration-200 ease-in-out',
      primary ? `bg-blue-500 text-white hover:bg-blue-400` : `bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white`,
      isDelete ? `bg-red-500 text-white hover:bg-red-400` : '',
      disabled ? 'opacity-50 cursor-not-allowed' : '',
      customClasses
    ]"
  >
    <span v-if="loading" class="animate-spin">Loading...</span> <span v-else>{{ text }}</span>
  </button>
</template>

<style scoped>
</style>
