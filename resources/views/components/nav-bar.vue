<template>

<section class="bg-primary">
    <div class="wrapper flex justify-between">
        <div id="brand" class="text-lg text-white font-bold py-4">
            Inventory System
        </div>
        <nav class="main-nav">
            <Link class="main-link" href="/">Home</Link>
            <Link v-if="user" class="main-link" href="/users">Users</Link>
            <Link v-if="user" class="main-link" href="/offices">Offices</Link>
            <Link v-if="user" class="main-link" href="/items">Items</Link>
        </nav>
        <div class="flex">
            <Link v-if="!user" class="py-4 text-green-100 font-semibold hover:bg-[#00250c] duration-300 px-2" href="/login">Log In</Link>
            <Link v-if="user" class="py-4 text-green-100 font-semibold hover:bg-[#00250c] duration-300 px-2" href="/logout" method="post" as="button">Log Out</Link>
        </div>
    </div>
</section>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'

defineProps({
    user: ''
})
</script>
