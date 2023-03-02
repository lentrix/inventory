<template layout="default">

    <div class="py-4">
        <h1 class="text-4xl">User Login</h1>
        <hr>
        <div class="max-w-sm border border-gray-400 shadow mt-4 p-4 rounded">
            <form @submit.prevent="submit">

                <div class="mb-4 flex flex-col">
                    <label for="username">User Name:</label>
                    <input v-model="form.username" type="text" class="rounded p-1 border border-gray-300 w-full">
                    <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
                </div>
                <div class="mb-4 flex flex-col">
                    <label for="password">Password:</label>
                    <input v-model="form.password" type="password" class="rounded p-1 border border-gray-300 w-full">
                    <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                </div>
                <div class="mb-4">
                    <button type="submit" class="py-2 rounded bg-green-700 px-4 hover:bg-green-600 text-white disabled:bg-gray-300">
                        Log In
                    </button>
                </div>
                <div class="text-sm text-red-500 italic" v-if="form.errors.authentication">{{ form.errors.authentication }}</div>

            </form>
        </div>
    </div>

</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'

let form = useForm({
    'username': '',
    'password': ''
})

let submit = () => {
    form.post('/login')
}

</script>
