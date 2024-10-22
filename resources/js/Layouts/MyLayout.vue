<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar/Index.vue';

onMounted(() => {
    initFlowbite();
})

</script>

<template>
    <Navbar></Navbar>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <Sidebar></Sidebar>

    </div>
    <div id="main-content" class="flex flex-col min-h-screen h-screen overflow-auto bg-gray-50 dark:bg-gray-900 lg:ml-64">
    
        <main class="flex-grow">
            <slot></slot>
        </main>
        <Footer class="px-4 pb-10"></Footer>
    </div>


</template>