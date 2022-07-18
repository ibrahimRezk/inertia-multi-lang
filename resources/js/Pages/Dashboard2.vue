<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { trans } from "laravel-vue-i18n";
import { wTrans } from "laravel-vue-i18n";
import { loadLanguageAsync } from "laravel-vue-i18n";
import { getActiveLanguage } from "laravel-vue-i18n";
import { isLoaded } from "laravel-vue-i18n";
import { stringLiteral } from "@babel/types";
import { computed, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const siteLang = getActiveLanguage(); // en
const loaded = isLoaded(); // false // need more review

const props = defineProps({
    name: {
        type: String,
    },
    locale: {
        type: String,
    },
});

const currentLanguage = document
    .getElementsByTagName("html")[0]
    .getAttribute("lang");

watch(
    () => trans("Dashboard"),
    () => {
        const lang = getActiveLanguage();
        const url = "/dashboard2/" + lang + "";
        Inertia.visit(url);
    }

    // we can use  // Inertia.reload() or // window.location.reload(), after inertia visit   but no need here because inertia.visit do the same thing;   
);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!-- {{ trans("Dashboard") }}
                {{ wTrans("Dashboard") }} -->
                {{ $t("Dashboard") }}
            </h2>
            <br />
            <br />
            {{ currentLanguage }}
            <br />

            {{  }}
            <br />
            {{ locale }}
<br />
            from handle inertia request : {{ $page.props.locale }}  <br />

            <br />
            <br />

            <br />

            <button @click="loadLanguageAsync('ar')">العربية</button>
            <br />
            <button @click="loadLanguageAsync('en')">English</button>
            <br /><br />
            activ lang :{{ siteLang }} <br />
            arabic lang loaded :{{ loaded }}
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
