<script setup>
import { defineProps } from 'vue';
import { Link } from "@inertiajs/vue3";
import BottomNavigation from './BottomNavigation.vue';

const props = defineProps({
    header: {
        type: String,
        default: 'Home'
    },
});
</script>
<template>
    <div class="sm:py-3 text-sm">
        <div class="mx-auto sm:px-4">
            <div class="flex flex-col lg:flex-row overflow-hidden">
                <!-- Left Column -->
                <div
                    class="lg:w-2/3 flex-shrink-0 sm:rounded-lg sm:border-2 sm:border-gray-300 dark:border-gray-700 h-screen sm:relative flex flex-col">
                    <!-- Kontainer untuk konten yang di-scroll -->
                    <div class="flex-grow overflow-y-auto scrollbar-hide">
                        <!-- Header -->
                        <div class="h-16 bg-main text-lg text-white rounded-t-md hidden sm:flex sm:sticky top-0 z-[1]">
                            <p class="m-auto font-semibold">
                                {{ header }}
                            </p>
                        </div>
                        <!-- Main Content -->
                        <slot name="main"></slot>
                    </div>
                    <!-- Kontainer untuk Bottom Navigation yang tetap -->
                    <div class="sm:absolute inset-x-0 bottom-0">
                        <BottomNavigation />
                    </div>
                </div>
                <!-- Right Column -->
                <div class="lg:w-1/3 lg:px-7 py-2 lg:py-0 flex-grow hidden lg:flex">
                    <slot name="content-right"></slot>
                </div>

            </div>
        </div>
    </div>
</template>