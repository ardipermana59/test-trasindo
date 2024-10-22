<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage()

</script>
<template>
    <footer class="my-10 text-sm text-center text-gray-500">
        © 2024 Made with ❣️ by
        <a :href="page.props.app.author_url ?? '/'" class="hover:underline text-blue-600" target="_blank">
            {{ page.props.app.app_author}}
        </a>.
        All rights reserved.
    </footer>
</template>
