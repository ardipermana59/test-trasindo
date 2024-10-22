<script setup>
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import MainCard from '@/Components/MainCard.vue';

</script>

<template>
    <AppLayout>

        <Head title="Dashboard" />
        <Breadcrumb current-page="Dashboard" page-title="Dashboard" />

        <div class="px-4 dark:text-white text-center">
            <MainCard>
                <div>
                    <h1>Selamat Datang Customer</h1>
                </div>
               
            </MainCard>
        </div>
    </AppLayout>
</template>