<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    error: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input ref="input" :class="[
        'bg-gray-50 border text-sm rounded-lg block w-full p-2.5',
        'dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',
        error
            ? 'border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500'
            : 'border-gray-300 text-gray-900 dark:text-white'
    ]" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
</template>