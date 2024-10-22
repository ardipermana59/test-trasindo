<script setup>
import PrimaryButton from '../PrimaryButton.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <PrimaryButton :type="type" class="inline-flex items-center">
        <PlusIcon />
        <slot />
    </PrimaryButton>
</template>