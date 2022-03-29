<template>
  <router-link :to="{ path: path }" v-slot="{ navigate }" custom>
    <button type="button" @click="navigate">{{ descripcion }}</button>
  </router-link>
</template>

<script setup lang="ts">
defineProps<{ path: string; descripcion: string }>();
</script>

<style scoped>
/* En este bloque se pueden definir las clases CSS */
</style>
