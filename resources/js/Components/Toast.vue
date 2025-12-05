<script setup>
import { ref, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const page = usePage();
const toasts = ref([]);

const addToast = (message, type = 'success') => {
    const id = Date.now();
    toasts.value.push({ id, message, type });
    setTimeout(() => removeToast(id), 5000);
};

const removeToast = (id) => {
    toasts.value = toasts.value.filter(toast => toast.id !== id);
};

const getTranslatedMessage = (flash) => {
    if (flash.success) {
        if (flash.success === 'broker_created') return t('toast.brokerCreated');
        if (flash.success === 'team_deleted') return t('toast.teamDeleted');
        return flash.success;
    }
    return null;
};

watch(() => page.props.flash, (flash) => {
    if (flash?.success) {
        const message = getTranslatedMessage(flash);
        if (message) addToast(message, 'success');
    }
}, { immediate: true, deep: true });

onMounted(() => {
    if (page.props.flash?.success) {
        const message = getTranslatedMessage(page.props.flash);
        if (message) addToast(message, 'success');
    }
});
</script>

<template>
    <div class="fixed bottom-4 right-4 z-50 flex flex-col gap-2">
        <TransitionGroup name="toast">
            <div
                v-for="toast in toasts"
                :key="toast.id"
                class="flex items-center gap-3 rounded-lg bg-white p-4 shadow-lg ring-1 ring-gray-900/5"
            >
                <span class="inline-flex size-8 items-center justify-center rounded-full bg-green-100">
                    <svg class="size-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                <p class="text-sm font-medium text-gray-900">{{ toast.message }}</p>
                <button
                    @click="removeToast(toast.id)"
                    class="ml-2 text-gray-400 hover:text-gray-600"
                >
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
    transition: all 0.3s ease;
}
.toast-enter-from {
    opacity: 0;
    transform: translateX(100%);
}
.toast-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>

