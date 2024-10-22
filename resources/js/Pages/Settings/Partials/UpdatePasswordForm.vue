<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MainCard from '@/Components/MainCard.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    const toastId = toast.loading("Memperbarui data...");
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => {
            toast.update(toastId, {
                render: "Password berhasil diperbarui!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
            form.reset()
        },
        onError: () => {
            toast.update(toastId, {
                render: "Gagal update password.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <MainCard class="mb-4 2xl:col-span-2">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Password information</h3>
        <form @submit.prevent="updatePassword">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">

                    <InputLabel for="current_password" value="Current Password" required/>

                    <TextInput id="current_password" ref="currentPasswordInput" :error="form.errors.current_password"
                        v-model="form.current_password" type="password" class="mt-1 block w-full" placeholder="••••••••"
                        autocomplete="current-password" required />

                    <InputError :message="form.errors.current_password" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="password" value="New Password" required/>

                    <TextInput id="password" ref="passwordInput" :error="form.errors.password" v-model="form.password"
                        type="password" class="mt-1 block w-full" placeholder="••••••••" autocomplete="new-password"
                        required />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="password_confirmation" value="Confirm Password" required/>

                    <TextInput id="password_confirmation" :error="form.errors.password_confirmation"
                        v-model="form.password_confirmation" type="password" class="mt-1 block w-full"
                        placeholder="••••••••" autocomplete="new-password" required />
                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-full">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Save
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </MainCard>
</template>