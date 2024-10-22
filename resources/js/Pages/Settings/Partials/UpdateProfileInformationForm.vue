<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

import ErrorList from '@/Components/ErrorList.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import FormGrid from '@/Components/FormGrid.vue';
import MainCard from '@/Components/MainCard.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
    profiles: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    address: props.profiles.address,
    contact: props.profiles.contact,
    village: props.profiles.village,
    district: props.profiles.district,
    city: props.profiles.city,
    province: props.profiles.province,
    description: props.profiles.description,
});

const verificationLinkSent = ref(null);

const updateProfileInformation = () => {
    const toastId = toast.loading("Memperbarui data...");
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => {
            toast.update(toastId, {
                render: "Data berhasil diperbarui!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
        },
        onError: () => {
            toast.update(toastId, {
                render: "Gagal memperbarui data.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
        },
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

</script>
<template>
    <MainCard class="mb-4 2xl:col-span-2">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
        <form @submit.prevent="updateProfileInformation">
            <ErrorList :errors="form.errors" />

            <FormGrid class="grid-cols-6 gap-x-6 gap-y-2">
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="name" value="Company Name" required />

                    <TextInput id="name" v-model="form.name" :error="form.errors.name" type="text"
                        class="mt-1 block w-full" placeholder="Enter your first name" required autocomplete="name" />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-3">

                    <InputLabel for="email" value="Email" required />

                    <TextInput id="email" v-model="form.email" :error="form.errors.email" type="email"
                        class="mt-1 block w-full" placeholder="youremail@gmail.com" required autocomplete="email" />
                    <InputError :message="form.errors.email" class="mt-2" />

                    <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                        <p class="text-sm mt-2 dark:text-white">
                            Your email address is unverified.

                            <Link :href="route('verification.send')" method="post" as="button"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                @click.prevent="sendEmailVerification">
                            Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="verificationLinkSent"
                            class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                </div>

                <!-- Customer -->
                <div v-if="user.role == 'customer'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="address" value="Address" required />

                    <TextInput id="address" v-model="form.address" :error="form.errors.address" type="text"
                        class="mt-1 block w-full" placeholder="Enter your address" required autocomplete="name" />

                    <InputError :message="form.errors.address" class="mt-2" />
                </div>

                <!-- Customer -->
                <div v-if="user.role == 'customer'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="contact" value="Contact" required />

                    <TextInput id="contact" v-model="form.contact" :error="form.errors.contact" type="text"
                        class="mt-1 block w-full" placeholder="Enter your contact" required autocomplete="contact" />

                    <InputError :message="form.errors.contact" class="mt-2" />
                </div>

                <!-- Merchant -->
                <div v-if="user.role == 'merchant'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="village" value="Village" required />

                    <TextInput id="village" v-model="form.village" :error="form.errors.village" type="text"
                        class="mt-1 block w-full" placeholder="Enter your village" required autocomplete="village" />

                    <InputError :message="form.errors.village" class="mt-2" />
                </div>
                <div v-if="user.role == 'merchant'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="district" value="district" required />

                    <TextInput id="district" v-model="form.district" :error="form.errors.district" type="text"
                        class="mt-1 block w-full" placeholder="Enter your district" required autocomplete="district" />

                    <InputError :message="form.errors.district" class="mt-2" />
                </div>
                <div v-if="user.role == 'merchant'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="city" value="city" required />

                    <TextInput id="city" v-model="form.city" :error="form.errors.city" type="text"
                        class="mt-1 block w-full" placeholder="Enter your city" required autocomplete="city" />

                    <InputError :message="form.errors.city" class="mt-2" />
                </div>
                <div v-if="user.role == 'merchant'" class="col-span-6 sm:col-span-3">
                    <InputLabel for="province" value="province" required />

                    <TextInput id="province" v-model="form.province" :error="form.errors.province" type="text"
                        class="mt-1 block w-full" placeholder="Enter your province" required autocomplete="province" />

                    <InputError :message="form.errors.province" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-full">
                    <PrimaryButton class="mt-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        type="submit">
                        Save
                    </PrimaryButton>
                </div>
            </FormGrid>
        </form>
    </MainCard>
</template>