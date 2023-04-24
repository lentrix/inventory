<template layout>

    <ConfirmDialog v-if="showConfirm"
                title="Delete Office?"
                message="Are you sure about deleting this office file?"
                @cancel="cancelDelete()"
                @confirm="deleteOffice()"></ConfirmDialog>

    <div class="bg-red-700 text-white p-4 rounded-lg my-3" v-if="errors.GeneralErrors">
        {{ errors.GeneralErrors }}
    </div>

    <div class="flex justify-between">
        <h1>List of Offices</h1>
    </div>

    <hr>

    <div class="flex space-x-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Serial #</th>
                    <th>Name</th>
                    <th>Building</th>
                    <th>In-charge</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="office in offices" :key="office.id">
                    <td>{{ ('00000000' + office.id) }}</td>
                    <td>{{ office.name }}</td>
                    <td>{{ office.building }}</td>
                    <td>{{ office.user.fullname }}</td>
                    <td class="text-center">
                        <button class="bg-green-700 px-2 rounded text-sm text-white" @click="edit(office)">E</button>
                        <button class="bg-red-700 px-2 rounded text-sm text-white ml-1" @click="remove(office)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="overflow-hidden duration-300" :class="toggle">

            <button class="btn primary" @click="toggleCreate">...</button>

            <div :class="isHidden">

                <form class="mt-4" @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="username">Office Name</label>
                        <input v-model="form.name" type="text" class="field" id="username">
                        <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Building</label>
                        <input v-model="form.building" type="text" class="field" id="username">
                        <div class="text-sm text-red-500 italic" v-if="form.errors.building">{{ form.errors.building }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Officer In-charge</label>
                        <!-- <input v-model="form.user_id" type="text" class="field" id="username"> -->
                        <select name="user_id" id="user_id" class="field" v-model="form.user_id">
                            <option value="">Select a user</option>
                            <option v-for="user in users" :value="user.id" :key="user.id">
                                {{ user.fullname }}
                            </option>
                        </select>
                        <div class="text-sm text-red-500 italic" v-if="form.errors.user_id">{{ form.errors.user_id }}</div>
                    </div>

                    <button class="btn primary" type="submit">
                        Save Changes
                    </button>
                </form>
            </div>

        </div>
    </div>



</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import ConfirmDialog from '@/views/components/confirm-dialog.vue';

let toggle = ref('w-[50px]')
let isHidden = ref('hidden')

let isNew = true;

let showConfirm = ref(false)

let form = useForm({
    name: '',
    building: '',
    user_id: ''
})

let deleteForm = useForm();

let selectedOffice = null
let selectedOfficeForDelete = null

let props = defineProps({
    offices: Array,
    users: Array,
    errors: null
})

let toggleCreate = () => {
    toggle.value = toggle.value == 'w-[50%]' ? 'w-[50px]' : 'w-[50%]'
    isHidden.value = isHidden.value == 'hidden' ? 'block' : 'hidden'
    if(isHidden.value=='block') {
        form.name = '',
        form.building = ''
        form.user_id = ''
        selectedOffice = null
    }
}

function edit(office) {
    toggle.value = 'w-[50%]'
    isHidden.value = 'block'
    form.name = office.name
    form.building = office.building,
    form.user_id = office.user_id
    selectedOffice = office
}

function submit() {
    if(selectedOffice) {
        form.put('/offices/' + selectedOffice.id)
    }else {
        form.post('/offices')
    }
}

function remove(office) {
    selectedOfficeForDelete = office
    showConfirm.value = true;
}

function cancelDelete() {
    showConfirm.value = false;
}

function deleteOffice() {
    deleteForm.delete('/offices/' + selectedOfficeForDelete.id)
    showConfirm.value = false;
}

</script>
