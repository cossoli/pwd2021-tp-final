<template>
  <nav>
    <router-link to="/">Menú inicial</router-link>
    <router-link to="/jugadores">Jugadores</router-link>
  </nav>
</template>

<script setup lang="ts">
//
</script>

<style scoped>
nav {
  display: flex;
  gap: 0.2em;

  background-color: rgb(70, 209, 133);
}
nav a {
  text-decoration: none;
  color: rgba(0, 58, 0, 0.801);
  padding: 0.5em;
  background-color: greenyellow;
}
nav a:hover {
  background-color: rgba(149, 207, 61, 0.849);
}
</style>
