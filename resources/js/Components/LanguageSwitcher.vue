<script setup>
import { useI18n } from 'vue-i18n';

const { locale } = useI18n();

const languages = [
    { code: 'fr-CA', name: 'FR', fullName: 'Français' },
    { code: 'en', name: 'EN', fullName: 'English' },
];

const switchLanguage = (code) => {
    locale.value = code;
    localStorage.setItem('locale', code);
    document.documentElement.lang = code;
};
</script>

<template>
    <div class="flex items-center gap-1 rounded-lg border border-gray-200 bg-white p-1">
        <button
            v-for="lang in languages"
            :key="lang.code"
            @click="switchLanguage(lang.code)"
            :title="lang.fullName"
            class="rounded-md px-2 py-1 text-xs font-medium transition"
            :class="locale === lang.code
                ? 'bg-indigo-600 text-white'
                : 'text-gray-600 hover:bg-gray-100'"
        >
            {{ lang.name }}
        </button>
    </div>
</template>

