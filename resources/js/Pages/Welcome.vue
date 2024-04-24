<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";

const props = defineProps(['phone_number', 'status', 'username'])
let showModal = false;
let userlink = '';
const form = useForm({
    username: '',
    phone_number: '',
});

const bindProps = {
    defaultCountry: "UA",
    onlyCountries: ["UA", "GB", "PL"],
    autoFormat: true,
    mode: "international",
    validCharactersOnly: true,
    inputOptions: {
        showDialCode: true,
        showDialCodeInList: true,
        enabledCountryCode: true,
        maxlength: 13,
        name: "phone_number",
        id: "phone_number",
        placeholder: "Enter a phone number",
        required: true,
    }
};

const submit = (e) => {
    form.phone_number = document.querySelector("#phone_number").value
    form.username = document.querySelector("#username").value
    form.post(route('register'), {
        onSuccess: (r) => showLink(r),
    })
};

function showLink(response) {
    showModal = true
    userlink = response.props.user_link
}

function isNumber(e) {
    let charCode = (e.which) ? e.which : e.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        e.preventDefault();
    } else {
        return true;
    }
}

</script>

<style>

.vue-tel-input {
    border-radius: 0.5rem !important;
}
</style>
<template>
    <GuestLayout>
        <Head title="Log in"/>

        <!--        <div v-if="status" class="mb-4 font-medium text-sm text-red-600">-->
        <!--            {{ status }}-->
        <!--        </div>-->

        <form class="max-w-sm mx-auto" id="register-form" @submit.prevent="submit">
            <!--            <csrf-token-input />-->
            <div class="mb-5">
                <InputLabel for="username" value="Username"/>
                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                    v-model="form.username"
                    :modelValue="form.username"
                    :model-value="form.username"/>

                <InputError class="mt-2" :message="form.errors.username"/>
            </div>
            <div class="mb-5">
                <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                    Number</label>
                <vue-tel-input
                    v-model="form.phone_number"
                    v-bind="bindProps"
                    @keypress="isNumber($event)"
                    :class="`border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 p-1 focus:border-blue-500 block w-full`">
                </vue-tel-input>
                <InputError class="mt-2" :message="form.errors.phone_number"/>

            </div>
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
        <Modal :show="showModal" :userlink="userlink"></Modal>
    </GuestLayout>
</template>
