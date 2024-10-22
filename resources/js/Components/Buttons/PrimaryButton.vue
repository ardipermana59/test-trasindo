<script setup>
import ButtonComponent from './ButtonComponent.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <ButtonComponent :type="type"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        <slot />
    </ButtonComponent>
</template>
    