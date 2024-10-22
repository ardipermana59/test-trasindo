<script setup>
import { defineProps } from 'vue';
import { Link, useForm } from "@inertiajs/vue3";

import WarningButton from '@/Components/Buttons/WarningButton.vue';

const props = defineProps({
    id: Object,
});

</script>
<template>
    <Link :href="route('caterings.invoice', props.id)" class="ml-3 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-400">Invoice</Link>
</template>