<template>
  <p v-if="jugador?.id == null">Cargando...</p>
  <article v-else>
    <h1>Edición del jugador: {{ jugador.nombre }}</h1>

    <form class="formulario" @submit="manejoSubmitDeFormulario($event)">
      <label>
        <span>ID:</span>
        <input type="text" name="id" :value="jugador.id" readonly disabled />
      </label>
      <label>
        <span>Fecha de ingreso:</span>
        <input
          type="text"
          name="ingreso"
          :value="jugador.ingreso.toLocaleDateString()"
          readonly
          disabled
        />
      </label>
      <label>
        <span>Nombre:</span>
        <input type="text" name="nombre" :value="jugador.nombre" />
      </label>
      <button>Guardar cambios</button>
    </form>
  </article>
</template>

<script setup lang="ts">
import { onBeforeMount } from '@vue/runtime-core';
import { ref } from '@vue/reactivity';

import {
  actualizarUnJugador,
  Jugador,
  leerUnJugador,
} from '../../modelo/jugador';
import { leerDatosDelFormulario } from '../../utilitarios/formulario';

const props = defineProps<{ id: string }>();
const jugador = ref<Jugador>();

onBeforeMount(async () => {
  jugador.value = await leerUnJugador(props.id);
});

async function manejoSubmitDeFormulario(evento: Event) {
  evento.preventDefault();

  const datosActualizados = leerDatosDelFormulario(evento);

  jugador.value = await actualizarUnJugador(props.id, datosActualizados);

  alert(`Jugador "${jugador.value!.nombre}" fue actualizado con éxito.`);
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
