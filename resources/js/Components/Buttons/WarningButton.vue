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
        class="bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-400">
        <slot />
    </ButtonComponent>
</template>
