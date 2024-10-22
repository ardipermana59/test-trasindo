<!-- <template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template> -->

<script>
import { initFlowbite } from 'flowbite'
export default {
    data() {
        return {
            isDarkMode: localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        };
    },
    onMounted() {
        initFlowbite();
    },
    mounted() {
        document.documentElement.classList.toggle('dark', this.isDarkMode);
    },
}
</script>
<template>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <slot name="logo" />
        <!-- Card -->
        <div class="w-full max-w-xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <slot />
        </div>
    </div>

</template>