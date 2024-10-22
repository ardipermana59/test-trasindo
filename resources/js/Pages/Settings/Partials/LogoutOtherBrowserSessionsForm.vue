<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MainCard from '@/Components/MainCard.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { toast } from 'vue3-toastify';

defineProps({
    sessions: Array,
});

const confirmingLogout = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmLogout = () => {
    confirmingLogout.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const logoutOtherBrowserSessions = () => {
    if(!form.password) {
        toast.error("Password tidak boleh kosong!", {
            autoClose: 2000,
        });
        return
    }
    const toastId = toast.loading("Loading...");
    form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.update(toastId, {
                render: "Berhasil hapus seluruh sesi!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
            closeModal()
        },
        onError: () => {
            toast.update(toastId, {
                render: "Gagal hapus sesi.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
            passwordInput.value.focus()
        },
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;

    form.reset();
};
</script>

<template>
    <MainCard class="mb-4 2xl:col-span-2">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Browser Sessions</h3>
        <div class="max-w-xl text-md text-gray-600 dark:text-white"> Manage and log out your active sessions on other
            browsers and devices. </div>

        <!-- Other Browser Sessions -->
        <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div>
                        <svg v-if="session.agent.is_desktop" class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>

                        <svg v-else class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </div>

                    <div class="ms-3">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device" class="text-green-500 font-semibold">This device</span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="flex items-center mt-5">
            <PrimaryButton @click="confirmLogout">
                Log Out Other Browser Sessions
            </PrimaryButton>
        </div>
        
        <ConfirmationModal :show="confirmingLogout" @close="confirmingLogout = false" @confirm="logoutOtherBrowserSessions"
            :isLoading="form.processing"
            :title="'Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.'"
            confirmButtonText="Ya, lanjutkan" cancelButtonText="Batal">
            <div>
                <InputError :message="form.errors.password" class="mt-2 text-left"/>
                <TextInput ref="passwordInput" v-model="form.password" :error="form.errors.password" type="password" class="mt-1 block w-3/4" :autocomplete="'password'"
                    placeholder="Password" autocomplete="current-password" @keyup.enter="logoutOtherBrowserSessions" required/>

            </div>
        </ConfirmationModal>

        
    </MainCard>
</template>
