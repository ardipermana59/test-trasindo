<script setup>
import ButtonComponent from './ButtonComponent.vue';

defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <ButtonComponent :type="type"
        class="bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
        <slot />
    </ButtonComponent>
</template>
