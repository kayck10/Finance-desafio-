import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import { createApp } from 'vue';
import Login from '../../finance-frontend/src/components/login.vue';
import Cadastro from '../../finance-frontend/src/components/cadastro.vue';
import Movimentacoes from '../../finance-frontend/src/components/movimentacoes.vue';
import formmovimentacoes from '../../finance-frontend/src/components/formmovimentacoes.vue';
import Dashboard from '../../finance-frontend/src/components/layouts/dashboard.vue';
import router from '../../finance-frontend/src/router/index.js'
import categorias from '../../finance-frontend/src/components/categorias.vue';
import FormCategoria from '../../finance-frontend/src/components/FormCategoria.vue';



const app = createApp({
  components: {
    Login,
    Cadastro,
    Movimentacoes,
    Dashboard,
    formmovimentacoes,
    categorias,
    FormCategoria
  }
}).use(router);

app.mount('#app');
