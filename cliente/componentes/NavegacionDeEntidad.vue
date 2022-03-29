<template>
  <nav>
    <router-link :to="{ path: `${route.path}/crear` }">Crear</router-link>
  </nav>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';

const route = useRoute();
</script>

<style scoped>
nav {
  display: flex;
  gap: 0.2em;

  background-color: rgb(79, 70, 209);
}
nav a {
  text-decoration: none;
  color: rgba(253, 255, 144, 0.801);
  padding: 0.5em;
  background-color: rgb(116, 109, 209);
}
nav a:hover {
  background-color: rgb(92, 83, 211);
}
</style>
