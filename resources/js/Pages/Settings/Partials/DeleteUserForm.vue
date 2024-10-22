<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/Buttons/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MainCard from '@/Components/MainCard.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <MainCard>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Delete Account</h3>
        <div class="max-w-xl text-md text-gray-600 dark:text-white">Permanently delete your account.</div>

        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
            your account, please download any data or information that you wish to retain.
        </div>

        <div class="mt-5">
            <DangerButton @click="confirmUserDeletion">
                Delete Account
            </DangerButton>
        </div>

        <!-- Delete Account Confirmation Modal -->
        <ConfirmationModal :show="confirmingUserDeletion" @close="closeModal" 
        :title="'Delete Account'"  :isLoading="form.processing">

            Are you sure you want to delete your account? Once your account is deleted, all of its resources and
            data will be permanently deleted. Please enter your password to confirm you would like to permanently
            delete your account.

            <div class="mt-4">
                <TextInput ref="passwordInput" v-model="form.password" :error="form.errors.password" type="password" class="mt-1 block w-3/4"
                    placeholder="Password" autocomplete="current-password" @keyup.enter="deleteUser" />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <template #actions>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>

                <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="deleteUser">
                    Delete Account
                </DangerButton>
            </template>
        </ConfirmationModal>
    </MainCard>
</template>
