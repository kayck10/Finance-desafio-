import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/layouts/dashboard.vue';
import Movimentacoes from '../components/movimentacoes.vue';
import formmovimentacoes from '../components/formmovimentacoes.vue';
import login from '../components/login.vue';
import categorias from '../components/categorias.vue';
import FormCategoria from '../components/FormCategoria.vue';


const routes = [
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
  },
  {
    path: '/movimentacoes',
    name: 'Movimentacoes',
    component: Movimentacoes,
  },
  {
    path: '/movimentacoes/nova',
    name: 'NovaMovimentacao',
    component: formmovimentacoes,
  },
  {
    path: '/login',
    name: 'Login',
    component: login,
  },
  {
    path: '/categorias',
    name: 'Categorias',
    component: categorias,
  },
  {
    path: '/categorias/nova',
    name: 'NovaCategoria',
    component: FormCategoria,
  },



];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
