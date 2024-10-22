<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Layouts/AuthenticationLayout.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>

    <Head title="Secure Area" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>


        <div class="flex space-x-4">
            <img class="w-8 h-8 rounded-full" src="/images/users/bonnie-green.png" alt="Bonnie image">
            <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Bonnie Green</h2>
        </div>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
            Better to be safe than sorry.
        </p>
        
        <form class="mt-8 space-y-6" @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" required autocomplete="current-password" autofocus
                    placeholder="**********" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="inline-flex" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path></svg>
                    Unlock
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
