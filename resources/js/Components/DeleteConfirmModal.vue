<script setup>
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

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
                <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="emit('close')"></div>
                <div class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-2xl">
                    <div class="mb-6 flex items-center gap-4">
                        <span class="inline-flex size-12 items-center justify-center rounded-full bg-red-100 text-red-600">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ title }}</h2>
                        </div>
                    </div>

                    <p class="mb-6 text-gray-600">{{ message }}</p>

                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            @click="emit('close')"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                        >
                            {{ t('common.cancel') }}
                        </button>
                        <button
                            type="button"
                            @click="emit('confirm')"
                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-red-700"
                        >
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ t('common.delete') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>

