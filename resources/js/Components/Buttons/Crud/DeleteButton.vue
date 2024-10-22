<script setup>
import DangerButton from '../DangerButton.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <DangerButton :type="type" class="inline-flex items-center">
        <TrashIcon />
        <slot />
    </DangerButton>
</template>