<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Layouts/AuthenticationLayout.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ErrorList from '@/Components/ErrorList.vue';
import SelectInput from '@/Components/SelectInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const urlParams = new URLSearchParams(window.location.search);
const referalCode = urlParams.get('referal_code');
if (referalCode) {
    form.referal_code = referalCode;
}
</script>

<template>

    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Create a Free Account
        </h2>


        <form class="mt-8" @submit.prevent="submit">
            <ErrorList :errors="form.errors" />

            <div class="">
                <InputLabel for="name" value="Name" required />
                <TextInput id="name" v-model="form.name" :error="form.errors.name" type="text" class="mt-1 block w-full"
                    required autofocus autocomplete="name" name="name" placeholder="Enter Name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>


            <div class="mt-3">
                <InputLabel for="email" value="Email" required />
                <TextInput id="email" v-model="form.email" :error="form.errors.email" type="email"
                    class="mt-1 block w-full" required autocomplete="username" placeholder="Enter Username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="password" value="Password" required />
                <TextInput id="password" v-model="form.password" :error="form.errors.password" type="password"
                    class="mt-1 block w-full" required autocomplete="new-password" placeholder="**********" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-3">
                <InputLabel for="password_confirmation" value="Confirm Password" required />
                <TextInput id="password_confirmation" v-model="form.password_confirmation"
                    :error="form.errors.password_confirmation" type="password" class="mt-1 block w-full" required
                    autocomplete="new-password" placeholder="**********" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div class="mt-3">
                <InputLabel for="role" value="Role" required />
                <SelectInput v-model="form.role" :error="form.errors.role" required>
                    <option value="">Pilih Role</option>
                    <option value="merchant">Merchant</option>
                    <option value="customer">Customer</option>
                </SelectInput>
            </div>


            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-3">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ms-2">
                            I agree to the <a target="_blank" :href="route('terms.show')"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms
                                of Service</a> and <a target="_blank" :href="route('policy.show')"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy
                                Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="sm:flex items-center justify-between mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>

                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                Already registered?
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
