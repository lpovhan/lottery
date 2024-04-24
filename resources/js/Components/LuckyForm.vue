<script setup>
import {ref} from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    win_number: {
        type: Number,
        default: 0
    },
    win_value: {
        type: Number,
        default: 0
    },
    win: {
        type: Boolean,
        default: false
    }
});

let isShow = ref(props.show)
let winNumber = ref(props.win_number)
let winValue = ref(props.win_value)
let win = ref(props.win)

function getLucky() {
    axios.get('/game')
        .then((response) => {
            winNumber.value = response.data.number
            isShow.value = true
            win.value = isWin(response.data.number)
            winValue.value = getWinValue(response.data.number)
        })
}

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

</script>

<template>

    <div
        class="flex flex-row items-center align-center content-center justify-center text-center space-x-2 mt-4 bg-gray-200 rounded-lg p-8">
        <span v-show="!isShow && winNumber === 0"><img src="/images/dice-game.gif"></span>
        <div v-show="isShow && win"><img src="/images/winner.gif"></div>

        <div v-show="isShow">
            <div v-show="!win">You lose!</div>
            <div style="font-size: 150px">{{ winNumber }}</div>
            <div v-show="win">You win ${{winValue}}!</div>
        </div>
    </div>

    <div class="flex items-center justify-center space-x-2 mt-4">
        <button @click="getLucky"
                class="animate-bounce focus:animate-none hover:animate-none border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
            Imfeelinglucky
        </button>
    </div>

</template>
