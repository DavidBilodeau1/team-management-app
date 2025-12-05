<script setup>
import { ref, reactive, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import axios from 'axios';

const { t } = useI18n();

const props = defineProps({
    show: Boolean,
    teamId: Number,
});

const emit = defineEmits(['close', 'success']);

const form = reactive({
    name: '',
    email: '',
});

const errors = ref({});
const processing = ref(false);

watch(() => props.show, (newVal) => {
    if (newVal) {
        form.name = '';
        form.email = '';
        errors.value = {};
    }
});

const submit = async () => {
    processing.value = true;
    errors.value = {};

    try {
        await axios.post(`/api/teams/${props.teamId}/brokers`, form);
        emit('success');
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors || {};
        }
    } finally {
        processing.value = false;
    }
};
</script>

<template>
    <Teleport to="body">
        <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="emit('close')"></div>
                <div class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-2xl">
                    <div class="mb-6 flex items-center gap-4">
                        <span class="inline-flex size-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ t('brokers.addBroker') }}</h2>
                            <p class="text-sm text-gray-500">{{ t('brokers.addBrokerDescription') }}</p>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ t('brokers.name') }}</label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :placeholder="t('brokers.enterName')"
                                required
                            />
                            <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name[0] }}</p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ t('brokers.email') }}</label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :placeholder="t('brokers.enterEmail')"
                                required
                            />
                            <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email[0] }}</p>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button
                                type="button"
                                @click="emit('close')"
                                class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                            >
                                {{ t('common.cancel') }}
                            </button>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700 disabled:opacity-50"
                            >
                                <svg v-if="processing" class="size-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ t('brokers.addBroker') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Teleport>
</template>

