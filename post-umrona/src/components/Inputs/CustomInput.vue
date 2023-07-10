<script setup>
const props = defineProps({
    type: {
        type: String,
    },
    label: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    placeholder: {
        type: String,
        required: true
    },
    modelValue: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    },
    isError: {
        type: Boolean,
        default: false
    },
    errorMessage: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <div class="mb-5">
        <label class="block text-md font-medium text-gray-700 mb-3">
            {{ label }} <span v-if="isError">*{{ errorMessage }}</span>
        </label>
        <div class="mt-1">
            <input v-bind="$attrs"
                :value="modelValue" 
                @input="$emit('update:modelValue', $event.target.value)"
                :name="name"
                :type="type" 
                :placeholder="placeholder" 
                :disabled="disabled"
                :class="[
                    `shadow-md focus:ring-emerald-500 focus:border-emerald-500 block w-full border px-5 py-3
                    transition duration-150 ease-in-out sm:text-sm rounded-md focus:outline-none 
                    focus:ring-2 focus:ring-opacity-50`,
                    disabled ? 'opacity-50 cursor-not-allowed' : '',
                    isError ? 'border-red-300 border-2' : 'border-slate-300'
                ]
                " 
            />
        </div>
    </div>
</template>

<style scoped>
</style>
