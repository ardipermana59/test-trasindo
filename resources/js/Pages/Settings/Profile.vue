<script setup>
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';


const props = defineProps({
    profiles: Object,
});

</script>

<template>
    <AppLayout>

        <Head title="Profile" />
        <Breadcrumb current-page="Profile" page-title="User Profile" />
        <div class="px-4">
            <div class="col-span-full">
                <UpdateProfileInformationForm :user="$page.props.auth.user" :profiles="profiles"/>
            </div>
        </div>
    </AppLayout>
</template>