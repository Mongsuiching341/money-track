<template>
    <div class="w-1/2">
        <div class="tabs ">
            <a @click="swapTb()" class="tab" :class="showBalanceForm ? 'tab-active' : ''">Add Balance</a>
            <a @click="swapTb()" class="tab " :class="showExpenseForm ? 'tab-active' : ''">Add Expense</a>
        </div>
        <div v-if="showBalanceForm" class="" id="add-balance-form">
            <form @submit.prevent="balanceForm">
                <div>
                    <label for="balance" class="block text-sm font-medium leading-6 text-gray-900">Balance</label>
                    <div class="mt-2">
                        <input v-model="form1.balance" id="balance" name="balance" type="number" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <button type="submit" class="bg-blue-400 py-3 px-2 rounded">Add Balance</button>
            </form>
        </div>
        <div v-if="showExpenseForm" class="" id="add-expense-form">
            <form @submit.prevent="expenseForm">
                <div>
                    <label for="expense" class="block text-sm font-medium leading-6 text-gray-900">Expense</label>
                    <div class="mt-2">
                        <input v-model="form2.expense" id="expense" name="expense" type="number" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Select Category</label>

                    <select v-model="form2.categories" name="category" class="select select-primary w-full max-w-xs">
                        <option disabled selected>What is the best TV show?</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>

                    </select>
                </div>
                <button type="submit" class="bg-blue-400 py-3 px-2 rounded">Add Expense</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import { usePage, router } from '@inertiajs/vue3'

const showBalanceForm = ref(true);
const showExpenseForm = ref(false);

const props = defineProps({
    categories: Object,
    msg: String,
})

function swapTb() {
    if (showBalanceForm.value) {
        showBalanceForm.value = false
        showExpenseForm.value = true
    } else {
        showBalanceForm.value = true
        showExpenseForm.value = false
    }
}

const form1 = useForm({
    'balance': null
})

const form2 = useForm({
    'expense': null,
    'categories': null,
})


const page = usePage()

function balanceForm() {
    form1.post('/add-balance', {


        onSuccess: () => {
            Toastify({
                text: page.props.flash.msg,
                className: "bg-blue-500",
            }).showToast();
        }
    })
}

function expenseForm() {
    form2.post('/add-expense', {
        onSuccess: () => {
            Toastify({
                text: 'Expense added',
                className: "bg-blue-500",
            }).showToast();
            router.visit('/');
        }
    })
}

</script>
