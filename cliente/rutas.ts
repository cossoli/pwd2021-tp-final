import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  { path: '/', component: () => import('./paginas/Inicio.vue') },
  {
    path: '/jugadores',
    component: () => import('./paginas/jugadores/ListadoDeJugadores.vue'),
  },
  {
    path: '/jugadores/crear',
    component: () => import('./paginas/jugadores/CrearJugador.vue'),
  },
  {
    path: '/jugadores/:id',
    component: () => import('./paginas/jugadores/DetalleJugador.vue'),
    props: (route) => ({ id: route.params.id }),
  },
];

export const plugin = createRouter({
  history: createWebHistory(),
  routes,
});
