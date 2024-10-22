<script setup>
import { defineProps, ref } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';

import ConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import DeleteButton from '@/Components/Buttons/Crud/DeleteButton.vue';

const props = defineProps({
    id: Number,
    routeName : String
});

const formDelete = useForm({});

const isDeleteModalVisible = ref(false);

const deleteUser = () => {
    const toastId = toast.loading("Menghapus data...");

    formDelete.delete(route(props.routeName, props.id), {
        preserveScroll: true,
        onSuccess: () => {
            isDeleteModalVisible.value = false;
            toast.update(toastId, {
                render: "Data berhasil dihapus!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
        },
        onError: () => {
            toast.update(toastId, {
                render: "Gagal menghapus data.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
        }
    });
};
</script>
<template>
    <DeleteButton @click="isDeleteModalVisible = true" type="button"/>

    <ConfirmationModal :show="isDeleteModalVisible" @close="isDeleteModalVisible = false" @confirm="deleteUser"
        :isLoading="formDelete.processing">
    </ConfirmationModal>

</template>