<template>
  <div class="container-fluid">
    <h2 class="mb-4">Nova Movimentação</h2>

    <!-- Formulário -->
    <form @submit.prevent="salvarMovimentacao">
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input
          type="text"
          class="form-control"
          id="descricao"
          v-model="movimentacao.descricao"
          required
        />
      </div>

      <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input
          type="number"
          class="form-control"
          id="valor"
          v-model="movimentacao.valor"
          step="0.01"
          required
        />
      </div>

      <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" v-model="movimentacao.data" required />
      </div>

      <!-- Categoria -->
      <div class="mb-3" v-if="categorias.length > 0">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-control" id="categoria_id" v-model="movimentacao.categoria_id" required>
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
            {{ categoria.nome }}
          </option>
        </select>
      </div>
      <div v-else>
        <p>Carregando categorias...</p>
      </div>

      <!-- Tipos de Movimentação -->
      <div v-if="tipos.length > 0">
        <label for="tipo_id" class="form-label">Tipo de Movimentação</label>
        <select class="form-control" id="tipo_id" v-model="movimentacao.tipo_id" required>
          <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id">
            {{ tipo.nome }}
          </option>
        </select>
      </div>
      <div v-else>
        <p>Carregando tipos de movimentação...</p>
      </div>

      <button type="submit" class="btn btn-primary">Salvar</button>
      <router-link to="/movimentacoes" class="btn btn-secondary ms-2">Cancelar</router-link>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const movimentacao = ref({
  descricao: '',
  valor: 0,
  data: new Date().toISOString().split('T')[0],
  categoria_id: null,
  tipo_id: null,
})

const categorias = ref([])
const tipos = ref([])

onMounted(() => {
  console.log('Componente montado')
  carregarDados()
})

const carregarDados = async () => {
  console.log('Iniciando a requisição para categorias e tipos')
  try {
    const responseCategorias = await axios.get('/api/categorias')
    console.log('Categorias:', responseCategorias.data)
    categorias.value = responseCategorias.data

    const responseTipos = await axios.get('/api/tipos-movimentacao')
    console.log('Tipos:', responseTipos.data)
    tipos.value = responseTipos.data
  } catch (error) {
    console.error('Erro ao carregar dados:', error.response ? error.response.data : error.message)
  }
}

const salvarMovimentacao = async () => {
  console.log('Movimentação antes de salvar:', movimentacao.value);
  try {
    const response = await axios.post('/api/movimentacoes', movimentacao.value);
    console.log('Movimentação salva:', response.data);
    router.push('/movimentacoes');
  } catch (error) {
    console.error('Erro ao salvar movimentação:', error.response?.data || error);
  }
};

</script>

<style scoped>
.container-fluid {
  padding: 20px;
}

h2 {
  color: #333;
}

.form-label {
  font-weight: bold;
}

.btn {
  margin-top: 10px;
}
</style>
