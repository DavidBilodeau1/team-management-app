<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    teams: Array,
});
</script>

<template>
    <Head title="Teams" />
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Teams</h1>
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <ul class="divide-y divide-gray-200">
                    <li v-for="team in teams" :key="team.id">
                        <Link
                            :href="`/teams/${team.id}`"
                            class="block hover:bg-gray-50 transition-colors"
                        >
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-medium text-gray-900">
                                        {{ team.name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ team.brokers_count }} broker(s)
                                    </p>
                                </div>
                                <svg
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </div>
                        </Link>
                    </li>
                    <li v-if="teams.length === 0" class="px-6 py-4 text-gray-500">
                        No teams found.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

