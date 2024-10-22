<script setup>
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import LogoutOtherBrowserSessionsForm from './Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from "./Partials/TwoFactorAuthenticationForm.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

</script>

<template>
    <AppLayout>

        <Head title="Security" />
        <Breadcrumb current-page="Security" page-title="User Security" />
        <div class="px-4">
          
            <div class="col-span-full">
                <UpdatePasswordForm />

            </div>

            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication"
                    class="mt-10 sm:mt-0" />

            </div>
            
            <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />


            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">

                <DeleteUserForm class="mt-10 sm:mt-0" />
            </template>
        </div>
    </AppLayout>
</template>