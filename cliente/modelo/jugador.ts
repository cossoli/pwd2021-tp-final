export interface JugadorBase {
  id: string;
  nombre: string;
}

export interface JugadorCrudo extends JugadorBase {
  ingreso: string;
}

export interface Jugador extends JugadorBase {
  ingreso: Date;
}

export function procesarJugador(jugador: JugadorCrudo): Jugador {
  return {
    ...jugador,
    ingreso: new Date(jugador.ingreso),
  };
}

export async function listarJugadores(): Promise<Jugador[]> {
  const respuesta = await fetch('/api/jugadores');
  const datos: JugadorCrudo[] = await respuesta.json();

  return datos.map(procesarJugador);
}

export async function leerUnJugador(id: string) {
  const respuesta = await fetch(`/api/jugadores/${id}`);

  return procesarJugador(await respuesta.json());
}

export async function actualizarUnJugador(
  id: string,
  nuevosDatos: Partial<Jugador>,
): Promise<Jugador> {
  const respuesta = await fetch(`/api/jugadores/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(nuevosDatos),
  });

  if (respuesta.ok) {
    return procesarJugador(await respuesta.json());
  }

  throw respuesta;
}

export async function borrarJugador(id: string) {
  const respuesta = await fetch(`/api/jugadores/${id}`, {
    method: 'DELETE',
  });

  if (!respuesta.ok) {
    throw respuesta;
  }
}

export async function crearJugador(datos: Partial<Jugador>): Promise<Jugador> {
  const respuesta = await fetch(`/api/jugadores`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(datos),
  });

  if (respuesta.ok) {
    return procesarJugador(await respuesta.json());
  }

  throw respuesta;
}
