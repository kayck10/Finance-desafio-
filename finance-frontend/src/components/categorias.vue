<template>
  <div class="container-fluid">
    <h2 class="mb-4">Lista de Categorias</h2>

    <!-- Botão para adicionar nova categoria -->
    <router-link to="/categorias/nova" class="btn btn-primary mb-4">
      <i class="bi bi-plus-circle"></i> Nova Categoria
    </router-link>

    <!-- Tabela de categorias -->
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="categoria in categorias" :key="categoria.id">
          <td>{{ categoria.id }}</td>
          <td>{{ categoria.nome }}</td>
          <td>
            <button class="btn btn-sm btn-primary me-2" @click="editarCategoria(categoria.id)">
              <i class="bi bi-pencil"></i> Editar
            </button>
            <button class="btn btn-sm btn-danger" @click="excluirCategoria(categoria.id)">
              <i class="bi bi-trash"></i> Excluir
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const categorias = ref([]);
const router = useRouter();

// Carregar categorias ao montar o componente
onMounted(async () => {
  try {
    const response = await axios.get('/api/categorias');
    categorias.value = response.data;
  } catch (error) {
    console.error('Erro ao carregar categorias:', error);
    alert('Erro ao carregar categorias.');
  }
});

// Método para editar categoria
const editarCategoria = (id) => {
  router.push(`/categorias/editar/${id}`);
};

// Método para excluir categoria
const excluirCategoria = async (id) => {
  if (confirm('Tem certeza que deseja excluir esta categoria?')) {
    try {
      await axios.delete(`/api/categorias/${id}`);
      categorias.value = categorias.value.filter((c) => c.id !== id);
      alert('Categoria excluída com sucesso!');
    } catch (error) {
      console.error('Erro ao excluir categoria:', error);
      alert('Erro ao excluir categoria.');
    }
  }
};
</script>

<style scoped>
.container-fluid {
  padding: 20px;
}

.table {
  margin-top: 20px;
}

.btn {
  margin-right: 5px;
}
</style>
