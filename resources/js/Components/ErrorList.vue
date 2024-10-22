<script setup>
import { computed } from 'vue';
import InfoIcon from './Icons/InfoIcon.vue';

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({}),
    },
    lang: {
        type: String,
        default: 'eng'  
    },
    text: {
        type: String,
        default: ''  
    }
});

const hasErrors = computed(() => Object.keys(props.errors).length > 0);

const alertText = computed(() => {
    if (props.text) {
        return props.text;  
    }
    return props.lang === 'ina'
        ? 'Pastikan persyaratan berikut terpenuhi:'
        : 'Ensure that these requirements are met:';
});
</script>

<template>
    <div v-if="hasErrors" class="flex p-3 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <InfoIcon :class="'flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]'"></InfoIcon>
        
        <span class="sr-only">Danger</span>
        <div>
            <span class="font-medium">{{ alertText }}</span> 
            <ul class="mt-1.5 list-disc list-inside">
                <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>
