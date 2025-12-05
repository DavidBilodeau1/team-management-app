<script setup>
defineProps({
    show: Boolean,
    title: String,
    message: String,
});

const emit = defineEmits(['close', 'confirm']);
</script>

<template>
    <Teleport to="body">
        <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-black bg-opacity-50" @click="emit('close')"></div>
                <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ title }}</h2>
                    <p class="text-gray-600 mb-6">{{ message }}</p>
                    <div class="flex justify-end space-x-3">
                        <button
                            type="button"
                            @click="emit('close')"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            @click="emit('confirm')"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>

