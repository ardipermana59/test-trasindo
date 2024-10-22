<script setup>
import { defineProps, ref } from 'vue';
import { router } from "@inertiajs/vue3";

import SearchIcon from './Icons/SearchIcon.vue';
import TextInput from './TextInput.vue';

const props = defineProps({
    search: String,
    routeName: String,
    placeholder: String
});

const searchTerm = ref(props.search || '');

const search = () => {
    router.get(route(props.routeName), { search: searchTerm.value }, { preserveState: true });
}
</script>

<template>
    <form @submit.prevent="search" class="mt-2">
        <div class="relative flex items-center">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">

                <SearchIcon class="w-4 h-4 text-gray-500 dark:text-gray-400" />

            </div>
            <TextInput class="ps-10 dark:bg-gray-700" v-model="searchTerm" type="search" id="search" :placeholder="placeholder ?? 'Search ...'"/>
            <button type="submit"
                class="absolute inset-y-0 end-0 flex items-center px-2 text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                <SearchIcon class="w-4 h-4" />
                
            </button>
        </div>
    </form>
</template>
