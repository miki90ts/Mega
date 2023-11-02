<template>
    <transition name="modal">
        <div class="modal-mask" v-if="showModal">
            <div
                class="modal-wrapper h-full flex items-center overflow-y-auto px-6"
            >
                <div
                    class="modal-container shadow-md rounded w-full py-8 px-3 relative"
                    style="max-width: 1000px"
                >
                    <slot />

                    <div class="mt-8 sm:flex sm:flex-row-reverse">
                        <div class="w-full mx-auto text-center">
                            <button
                                class="px-6 py-2 text-md bg-gray-500 hover:bg-gray-600 text-white rounded mr-5 focus:outline-none"
                                @click.stop="emit('modal-close')"
                            >
                                Откажите
                            </button>
                            <button
                                type="button"
                                class="px-6 py-2 text-md bg-blue-500 hover:bg-blue-600 text-white rounded focus:outline-none"
                                @click.stop="emit('action')"
                            >
                                Потврдите
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<style>
.modal-mask {
    position: fixed;
    z-index: 10000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-container {
    margin: 50px auto;
    background-color: #fff;
    transition: all 0.3s ease;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>

<script setup>
const props = defineProps({
    showModal: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["modal-close", "action"]);
</script>
