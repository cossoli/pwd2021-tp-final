<template>
  <NavegacionPrincipal />

  <router-view></router-view>
</template>

<script setup lang="ts">
import NavegacionPrincipal from './componentes/NavegacionPrincipal.vue';
</script>

<style>
html,
body {
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
