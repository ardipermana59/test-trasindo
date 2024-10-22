<script setup>
import { ref, reactive, nextTick } from 'vue';
import ConfirmationModal from './ConfirmationModal.vue';
import InputError from './InputError.vue';
import PrimaryButton from './Buttons/PrimaryButton.vue';
import SecondaryButton from './SecondaryButton.vue';
import TextInput from './TextInput.vue';
import { toast } from 'vue3-toastify';

const emit = defineEmits(['confirmed']);

defineProps({
    title: {
        type: String,
        default: 'Confirm Password',
    },
    content: {
        type: String,
        default: 'For your security, please confirm your password to continue.',
    },
    button: {
        type: String,
        default: 'Confirm',
    },
});

const confirmingPassword = ref(false);

const form = reactive({
    password: '',
    error: '',
    processing: false,
});

const passwordInput = ref(null);

const startConfirmingPassword = () => {
    axios.get(route('password.confirmation')).then(response => {
        if (response.data.confirmed) {
            emit('confirmed');
        } else {
            confirmingPassword.value = true;

            setTimeout(() => passwordInput.value.focus(), 250);
        }
    });
};

const confirmPassword = () => {
    if(!form.password) {
        toast.error("Password tidak boleh kosong!", {
            autoClose: 2000,
        });
        return
    }
    form.processing = true;

    axios.post(route('password.confirm'), {
        password: form.password,
    }).then(() => {
        form.processing = false;

        closeModal();
        nextTick().then(() => emit('confirmed'));

    }).catch(error => {
        form.processing = false;
        form.error = error.response.data.errors.password[0];
        toast.error(error.response.data.errors.password[0], {
            autoClose: 2000,
        });
        passwordInput.value.focus();
    });
};

const closeModal = () => {
    confirmingPassword.value = false;
    form.password = '';
    form.error = '';
};
</script>

<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <ConfirmationModal :show="confirmingPassword" @close="closeModal" :title="title">
            {{ content }}

            <div class="mt-4">
                <InputError :message="form.error" class="mt-2 text-left" />
                <TextInput ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4"
                    placeholder="Password" autocomplete="current-password" @keyup.enter="confirmPassword" />

            </div>

            <template #actions>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="confirmPassword">
                    {{ button }}
                </PrimaryButton>
                <SecondaryButton class="ms-3"  @click="closeModal">
                    Cancel
                </SecondaryButton>
            </template>
        </ConfirmationModal>
    </span>
</template>
