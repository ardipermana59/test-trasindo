<script setup>
import PenIcon from '@/Components/Icons/PenIcon.vue';
import WarningButton from '../WarningButton.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <WarningButton :type="type" class="inline-flex items-center">
        <PenIcon />
        <slot />
    </WarningButton>
</template>