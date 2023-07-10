<script setup>
import CustomButton from '../Buttons/CustomButton.vue';

defineProps({
    post: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="post-card w-[250px] h-[200px] bg-white shadow-2xl p-5 rounded-lg">
        <div class="post-header text-slate-600 h-2/3">
            <h1 class="font-bold text-2xl truncate overflow-hidden w-4/5">
                {{ post.title }}
            </h1>
            <p class="text-sm text-slate-500 border-b border-slate-400 pb-3">By {{ post.author }}</p>
        </div>
        <div class="w-full flex items-center gap-5">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
