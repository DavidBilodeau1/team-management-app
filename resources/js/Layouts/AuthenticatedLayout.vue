<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import Toast from '@/Components/Toast.vue';
import { Link } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex min-h-screen flex-col bg-gray-50">
        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-4">
                        <Link :href="route('teams.index')" class="flex items-center gap-2">
                            <span class="inline-flex size-10 items-center justify-center rounded-lg bg-indigo-600">
                                <svg class="size-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </span>
                            <span class="text-xl font-bold text-gray-900">{{ t('app.name') }}</span>
                        </Link>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:gap-4">
                        <Link
                            :href="route('teams.index')"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                            :class="{ 'bg-gray-100 text-gray-900': route().current('teams.*') }"
                        >
                            {{ t('nav.teams') }}
                        </Link>

                        <LanguageSwitcher />

                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        type="button"
                                        class="flex items-center gap-2 rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
                                    >
                                        <span class="inline-flex size-8 items-center justify-center rounded-full bg-indigo-100">
                                            <span class="text-sm font-medium text-indigo-700">
                                                {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                                            </span>
                                        </span>
                                        <span>{{ $page.props.auth.user.name }}</span>
                                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">{{ t('nav.profile') }}</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">{{ t('nav.logout') }}</DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <div class="sm:hidden">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="rounded-lg p-2 text-gray-600 hover:bg-gray-100"
                        >
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    v-if="!showingNavigationDropdown"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    v-else
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <div v-show="showingNavigationDropdown" class="border-t border-gray-200 py-4 sm:hidden">
                    <div class="space-y-1">
                        <ResponsiveNavLink :href="route('teams.index')" :active="route().current('teams.*')">
                            {{ t('nav.teams') }}
                        </ResponsiveNavLink>
                    </div>

                    <div class="mt-4 border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between px-4">
                            <div>
                                <div class="text-base font-medium text-gray-800">{{ $page.props.auth.user.name }}</div>
                                <div class="text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>
                            <LanguageSwitcher />
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">{{ t('nav.profile') }}</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">{{ t('nav.logout') }}</ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>

        <Toast />
    </div>
</template>
