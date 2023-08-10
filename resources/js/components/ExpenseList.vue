<template>
    <div>
        <span v-if="showLoader" class="loading loading-ring loading-lg"></span>

        <div class="overflow-x-auto w-4/5 my-4">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Expense</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ex in expenses">
                        <th>{{ ex.id }}</th>
                        <td>{{ ex.expense }}</td>
                        <td>{{ ex.category.name }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref} from 'vue';

const expenses = ref([]);
const showLoader = ref(true);


axios.get('/expenseList')
    .then(function (response) {
        // handle success
        showLoader.value = false;
        expenses.value = [...response.data.expenseList]
        // console.log(response.data.expenseList);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })



</script>

