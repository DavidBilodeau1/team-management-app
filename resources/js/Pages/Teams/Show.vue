<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AddBrokerModal from '@/Components/AddBrokerModal.vue';
import DeleteConfirmModal from '@/Components/DeleteConfirmModal.vue';

const props = defineProps({
    team: Object,
});

const showAddBrokerModal = ref(false);
const showDeleteModal = ref(false);

const deleteTeam = () => {
    router.delete(`/teams/${props.team.id}`, {
        onSuccess: () => {
            showDeleteModal.value = false;
        },
    });
};
</script>

<template>
    <Head :title="team.name" />
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <Link href="/" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Teams
                </Link>
            </div>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">{{ team.name }}</h1>
                    <div class="flex space-x-3">
                        <button
                            @click="showAddBrokerModal = true"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                        >
                            Add Broker
                        </button>
                        <button
                            @click="showDeleteModal = true"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                        >
                            Delete Team
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Brokers</h2>
                    <ul class="divide-y divide-gray-200">
                        <li v-for="broker in team.brokers" :key="broker.id" class="py-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-900 font-medium">{{ broker.name }}</p>
                                    <p class="text-gray-500 text-sm">{{ broker.email }}</p>
                                </div>
                            </div>
                        </li>
                        <li v-if="team.brokers.length === 0" class="py-3 text-gray-500">
                            No brokers in this team.
                        </li>
                    </ul>
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
        title="Delete Team"
        message="Are you sure you want to delete this team? All brokers in this team will also be deleted. This action cannot be undone."
        @close="showDeleteModal = false"
        @confirm="deleteTeam"
    />
</template>

