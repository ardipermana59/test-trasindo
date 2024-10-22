<script setup>
import { computed, defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: String,
    error: Boolean
});

const emit = defineEmits(['update:modelValue']);

const internalValue = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit('update:modelValue', value);
    }
});
</script>

<template>
    <select v-model="internalValue"
        :class="[
            'bg-gray-50 border text-sm rounded-lg block w-full p-2.5',
            'dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white',
            error
                ? 'border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                : 'border-gray-300 text-gray-900 dark:text-white'
        ]">
        <slot></slot>
    </select>
</template>
