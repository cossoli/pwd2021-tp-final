<template>
  <article>
    <h1>Carga de nuevo jugador</h1>
    <form class="formulario" @submit="manejoSubmitDeFormulario($event)">
      <label>
        <span>Nombre:</span>
        <input type="text" name="nombre" />
      </label>
      <button>Crear</button>
    </form>
  </article>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';

import { crearJugador } from '../../modelo/jugador';
import { leerDatosDelFormulario } from '../../utilitarios/formulario';

const router = useRouter();

async function manejoSubmitDeFormulario(evento: Event) {
  evento.preventDefault();

  const datos = leerDatosDelFormulario(evento);
  const jugador = await crearJugador(datos);

  alert(`El jugador ${jugador.nombre} se creó exitosamente.`);

  router.push('/jugadores');
}
</script>

<style scoped>
.formulario {
  display: flex;
  flex-direction: column;

  gap: 1em;
}
.formulario label :first-child {
  margin-right: 0.5em;
}
</style>
