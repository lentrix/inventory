<template layout="default">

    <h1>Edit User {{ user.fullname }}</h1>

    <div class="w-[500px] shadow p-4 ">
        <form @submit.prevent="submit">
            <div clas="mb-3">
                <label for="username">User Name</label>
                <input v-model="form.username" type="text" class="field" id="username">
                <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
            </div>
            <div class="mb-3">
                <label for="fullname">Full Name</label>
                <input v-model="form.fullname" type="text" class="field" id="fullname">
                <div class="text-sm text-red-500 italic" v-if="form.errors.fullname">{{ form.errors.fullname }}</div>
            </div>
            <div class="mb-3">
                <label for="designation">Designation</label>
                <input v-model="form.designation" type="text" class="field" id="designation">
                <div class="text-sm text-red-500 italic" v-if="form.errors.designation">{{ form.errors.designation }}</div>
            </div>
            <div class="mb-3">
                <label for="department">Department</label>
                <input v-model="form.department" type="text" class="field" id="department">
                <div class="text-sm text-red-500 italic" v-if="form.errors.department">{{ form.errors.department }}</div>
            </div>
            <div>
                <button class="btn primary" type="submit">
                    Save Changes
                </button>
            </div>
        </form>
    </div>


</template>

<script setup>

import { useForm, usePage } from '@inertiajs/inertia-vue3'
import { setTransitionHooks } from 'vue';

const props = defineProps({
    user: Object
})

let form = useForm({
    username: props.user.username,
    fullname: props.user.fullname,
    designation: props.user.designation,
    department: props.user.department
})

const submit = () => {
    form.put('/users/' + props.user.id)
}

</script>
