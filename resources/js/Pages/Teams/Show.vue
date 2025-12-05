<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddBrokerModal from '@/Components/AddBrokerModal.vue';
import DeleteConfirmModal from '@/Components/DeleteConfirmModal.vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({
    team: Object,
});

const showAddBrokerModal = ref(false);
const showDeleteModal = ref(false);

const deleteTeam = () => {
    router.delete(route('teams.destroy', props.team.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
        },
    });
};
</script>

<template>
    <Head :title="team.name" />
    <AuthenticatedLayout>
        <div class="space-y-6">
            <div>
                <Link :href="route('teams.index')" class="inline-flex items-center gap-1 text-sm font-medium text-indigo-600 hover:text-indigo-800">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    {{ t('teams.backToTeams') }}
                </Link>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-gray-200 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="inline-flex size-14 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ team.name }}</h1>
                            <p class="text-sm text-gray-500">{{ t('teams.brokerCount', { count: team.brokers.length }) }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button
                            @click="showAddBrokerModal = true"
                            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700"
                        >
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ t('brokers.addBroker') }}
                        </button>
                        <button
                            @click="showDeleteModal = true"
                            class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50"
                        >
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ t('teams.deleteTeam') }}
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="mb-4 text-lg font-semibold text-gray-900">{{ t('brokers.title') }}</h2>

                    <div v-if="team.brokers.length > 0" class="overflow-hidden rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">{{ t('brokers.name') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">{{ t('brokers.email') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="broker in team.brokers" :key="broker.id" class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="inline-flex size-10 items-center justify-center rounded-full bg-gray-100">
                                                <span class="text-sm font-medium text-gray-600">{{ broker.name.charAt(0).toUpperCase() }}</span>
                                            </span>
                                            <span class="font-medium text-gray-900">{{ broker.name }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-gray-500">{{ broker.email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-else class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                        <svg class="mx-auto size-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="mt-3 text-sm font-medium text-gray-900">{{ t('brokers.noBrokers') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ t('brokers.noBrokersDescription') }}</p>
                        <button
                            @click="showAddBrokerModal = true"
                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                        >
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ t('brokers.addBroker') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <AddBrokerModal
            :show="showAddBrokerModal"
            :team-id="team.id"
            @close="showAddBrokerModal = false"
        />
        <DeleteConfirmModal
            :show="showDeleteModal"
            :title="t('teams.deleteTeamTitle')"
            :message="t('teams.deleteTeamMessage')"
            @close="showDeleteModal = false"
            @confirm="deleteTeam"
        />
    </AuthenticatedLayout>
</template>

