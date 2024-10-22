<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" :id="id" class="fixed inset-0 flex items-center justify-center z-50">
                <!-- Backdrop tanpa transisi -->
                <div class="fixed inset-0 bg-black opacity-50" @click="close"></div>

                <!-- Modal -->
                <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show"
                        class="relative bg-white dark:bg-gray-700 rounded-lg shadow z-50 mx-5 pt-6 w-full max-w-lg"
                        :class="maxWidthClass">
                        <div class="px-6 py-4">

                            <div class="text-center flex justify-center">
                                <div>
                                    <div style="border-top-color:transparent"
                                        class="w-16 h-16 border-4 border-primary border-solid rounded-full animate-spin">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script>
import { defineComponent, onMounted, onUnmounted } from "vue";

export default defineComponent({
    emits: ['close'],

    props: {
        show: {
            type: Boolean,
            default: false
        },
        maxWidth: {
            type: String,
            default: '2xl'
        },
        closeable: {
            type: Boolean,
            default: true
        },
        id: {
            type: String,
            default: ''
        }
    },

    watch: {
        show: {
            immediate: true,
            handler(show) {
                if (show) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = null;
                }
            }
        }
    },

    setup(props, { emit }) {
        const close = () => {
            if (props.closeable) {
                emit('close');
            }
        };

        const closeOnEscape = (e) => {
            if (e.key === 'Escape' && props.show) {
                close();
            }
        };

        onMounted(() => document.addEventListener('keydown', closeOnEscape));
        onUnmounted(() => {
            document.removeEventListener('keydown', closeOnEscape);
            document.body.style.overflow = null;
        });

        return {
            close
        };
    },

    computed: {
        maxWidthClass() {
            return {
                'sm': 'sm:max-w-sm',
                'md': 'sm:max-w-md',
                'lg': 'sm:max-w-lg',
                'xl': 'sm:max-w-xl',
                '2xl': 'sm:max-w-2xl'
            }[this.maxWidth];
        }
    }
});
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.3s;
}

.modal-fade-enter,
.modal-fade-leave-to {
    opacity: 0;
}
</style>