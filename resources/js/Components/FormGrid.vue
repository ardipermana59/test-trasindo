<script setup>
defineProps({
    cols: {
        type: Number,
        default: 2
    }
});
</script>

<template>
    <div :class="`grid gap-2 mb-4 grid-cols-${cols}`">
        <slot></slot>
    </div>
</template>
