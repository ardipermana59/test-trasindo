<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="px-3 py-2 text-sm font-medium text-center text-white rounded-lg">
        <slot />
    </button>
</template>