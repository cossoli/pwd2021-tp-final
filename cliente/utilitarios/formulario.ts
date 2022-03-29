export function leerDatosDelFormulario(evento: Event) {
  return Object.fromEntries(
    new FormData(evento.target as HTMLFormElement).entries(),
  );
}
