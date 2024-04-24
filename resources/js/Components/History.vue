<script setup>

import {ref} from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    items: {
        type: Object,
        default: {}
    }
});

let isShow = ref(props.show)
let items = ref(props.items)

function getWinValue(n) {
    let result = 0

    if (n > 900) {
        result = n * 0.7
    } else if (n > 600) {
        result = n * 0.5
    } else if (n > 300) {
        result = n * 0.3
    } else if (n > 1) {
        result = n * 0.1
    }

    return Math.round(result)
}

function isWin(number) {
    return number % 2 === 0
}

function getHistory() {
    axios.get('/last-games')
        .then((response) => {
            items.value = response.data
            isShow.value = true
        })
}

</script>

<template>
    <div class="flex items-center justify-center space-x-2 mt-4">
        <button @click="getHistory"
                class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline">
            History
        </button>
    </div>
    <div v-show="isShow" class="items-center justify-center space-x-2 mt-4 bg-gray-200 rounded-lg p-8 text-center">
        <p class="font-bold uppercase">Last results</p>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-100 uppercase">№</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-100 uppercase">Datetime</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-100 uppercase">Number</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-100 uppercase">Result</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-100 uppercase">Win</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="(item, i) in items">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-600">{{ i+1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-600">{{ (new Date(item.created_at)).toUTCString() }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-600">{{ item.number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-600">{{ isWin(item.number) ? "Win": "Lose" }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-600">{{ isWin(item.number) ? '$' + getWinValue(item.number) : ''}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
