<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useI18n } from 'vue-i18n';
import axios from 'axios';

const { t } = useI18n();

const teams = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get('/api/teams');
        teams.value = response.data;
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <Head :title="t('teams.title')" />
    <AuthenticatedLayout>
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ t('teams.title') }}</h1>
                <p class="mt-1.5 text-sm text-gray-500">{{ t('teams.description') }}</p>
            </div>

            <div v-if="loading" class="flex justify-center py-12">
                <svg class="size-8 animate-spin text-indigo-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <div v-else-if="teams.length > 0" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <Link
                    v-for="team in teams"
                    :key="team.id"
                    :href="route('teams.show', team.id)"
                    class="group relative block rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-indigo-500 hover:shadow-lg"
                >
                    <div class="flex items-center gap-4">
                        <span class="inline-flex size-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ team.name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ t('teams.brokerCount', { count: team.brokers?.length || 0 }) }}</p>
                        </div>
                    </div>

                    <span class="absolute inset-x-0 bottom-0 h-1 rounded-b-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-0 transition group-hover:opacity-100"></span>
                </Link>
            </div>

            <div v-else class="rounded-xl border border-dashed border-gray-300 bg-white p-12 text-center">
                <svg class="mx-auto size-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">{{ t('teams.noTeams') }}</h3>
                <p class="mt-2 text-sm text-gray-500">{{ t('teams.noTeamsDescription') }}</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

