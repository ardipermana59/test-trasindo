<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage()

</script>

<template>
    <Link :href="'/'" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
    <img src="/logo.png" class="mr-4 h-11" :alt="page.props.app">
    <span>{{ page.props.app}}</span>
    </Link>
</template>
