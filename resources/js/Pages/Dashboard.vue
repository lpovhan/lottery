<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import History from "@/Components/History.vue";
import LuckyForm from "@/Components/LuckyForm.vue";


function deactivateLink() {
    axios.get('/deactivate')
        .then((response) => {
            router.visit('/')
        })
}

function regenerateLink() {
    axios.get('/new-link')
        .then((response) => {
            router.visit(response.data.url)
        })
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">

                <div class="basis-1/2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
                </div>

                <div class="basis-1/2 text-right">
                    <!--                    <span class="inline-block mr-2 mb-2">-->
                    <!--                        <Link href="" class="px-4 py-2 text-white uppercase tracking-wide no-underline text-sm font-semibold rounded shadow inline-block bg-gray-400 hover:bg-gray-500">Buy on Amazon USA-->
                    <!--                        </Link>-->
                    <!--                    </span>-->
                    <button @click="deactivateLink"
                            class="mr-5 px-4 py-2 text-white uppercase tracking-wide no-underline text-sm font-semibold rounded shadow inline-block bg-gray-400 hover:bg-gray-500">
                        Deactivate link
                    </button>
                    <button @click="regenerateLink"
                            class="px-4 py-2 text-white uppercase tracking-wide no-underline text-sm font-semibold rounded shadow inline-block bg-teal-500 hover:bg-teal-600">
                        Generate new link
                    </button>
                </div>

            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="items-center justify-center p-6 text-gray-900">

                        <LuckyForm></LuckyForm>

                        <History></History>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
