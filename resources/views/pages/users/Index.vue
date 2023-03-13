<template layout>
    <div class="flex justify-between">
        <h1>List of Users</h1>
        <!-- <Link href="/users/create" class="btn-primary">Create User</Link> -->
    </div>

    <hr class="my-3">

    <div class="flex space-x-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Serial #</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" :key="user.id">
                    <td>{{ ('00000000' + user.id).slice(-8) }}</td>
                    <td>{{ user.fullname }}</td>
                    <td>{{ user.designation }}</td>
                    <td>{{ user.department }}</td>
                </tr>
            </tbody>
        </table>
        <div class="overflow-hidden duration-300" :class="toggle">
            <button class="btn primary" @click="toggleCreate">...</button>
            <div :class="isHidden">
                <h3 class="text-xl mt-4">User Creation Form</h3>

                <div class="mt-4">
                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="username">User Name</label>
                            <input v-model="form.username" type="text" class="field" id="username">
                            <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input v-model="form.password" type="password" class="field" id="password">
                            <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fullname">Full Name</label>
                            <input v-model="form.fullname" type="text" class="field" id="fullname">
                            <div class="text-sm text-red-500 italic" v-if="form.errors.fullname">{{ form.errors.fullname }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="designation">Designation</label>
                            <input v-model="form.designation" type="text" class="field" id="designation">
                            <div class="text-sm text-red-500 italic" v-if="form.errors.designation">{{
                                form.errors.designation }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="department">Department</label>
                            <input v-model="form.department" type="text" class="field" id="department">
                            <div class="text-sm text-red-500 italic" v-if="form.errors.department">{{ form.errors.department
                            }}</div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="btn primary" type="submit">
                                Create User
                            </button>
                            <button type="reset" class="btn secondary">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// import {Link} from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

let toggle = ref('w-[50px]')
let isHidden = ref('hidden')

defineProps({
    'users': Array
})

let toggleCreate = () => {
    toggle.value = toggle.value == 'w-[50%]' ? 'w-[50px]' : 'w-[50%]'
    isHidden.value = isHidden.value == 'hidden' ? 'block' : 'hidden'
    console.log("Toggle...", toggle.value)
}

let form = useForm({
    username: '',
    password: '',
    fullname: '',
    designation: '',
    department: ''
})

const submit = () => {
    form.post('/users')
}
</script>
