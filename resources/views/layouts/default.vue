<script setup lang="ts">
import NavBar from '../components/nav-bar.vue'

</script>

<template>
    <NavBar></NavBar>
	<div class="wrapper py-8">
        <slot />
    </div>
</template>
