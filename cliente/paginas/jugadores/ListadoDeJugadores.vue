<template>
  <NavegacionDeEntidad />
  <article>
    <h1>Jugadores</h1>
    <p v-if="jugadores.length === 0">Cargando...</p>
    <table v-if="jugadores.length > 0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Ingreso</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="jugador in jugadores">
          <td>{{ jugador.id }}</td>
          <td>{{ jugador.nombre }}</td>
          <td>{{ jugador.ingreso.toLocaleDateString() }}</td>
          <td>
            <BotonNavegacion
              :path="`/jugadores/${jugador.id}`"
              descripcion="Editar"
            />
            |
            <button type="button" @click="invocarBorrarJugador(jugador.id)">
              Borrar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </article>
</template>

<script setup lang="ts">
import { onMounted } from '@vue/runtime-core';
import { ref } from '@vue/reactivity';

import NavegacionDeEntidad from '../../componentes/NavegacionDeEntidad.vue';
import { borrarJugador, Jugador, listarJugadores } from '../../modelo/jugador';
import BotonNavegacion from '../../componentes/BotonNavegacion.vue';

const jugadores = ref<Jugador[]>([]);

onMounted(async () => {
  jugadores.value = await listarJugadores();
});

async function invocarBorrarJugador(id: string) {
  await borrarJugador(id);

  alert('Se borró el jugador exitosamente!');

  jugadores.value = await listarJugadores();
}
</script>

<style scoped>
a {
  color: #42b983;
}

table,
th,
td {
  border: 1px solid black;
}
</style>
