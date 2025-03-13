<template>
  <div class="container-fluid">
    <h2 class="mb-4">{{ modoEdicao ? 'Editar Categoria' : 'Nova Categoria' }}</h2>

    <!-- Formulário de criação/edição -->
    <form @submit.prevent="salvarCategoria">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input
          type="text"
          class="form-control"
          id="nome"
          v-model="categoria.nome"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">
        {{ modoEdicao ? 'Salvar Alterações' : 'Criar Categoria' }}
      </button>
      <router-link to="/categorias" class="btn btn-secondary ms-2">Cancelar</router-link>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const categoria = ref({ nome: '' });
const modoEdicao = ref(false);

// Verifica se é uma edição
onMounted(async () => {
  if (route.params.id) {
    modoEdicao.value = true;
    try {
      const response = await axios.get(`/api/categorias/${route.params.id}`);
      categoria.value = response.data;
    } catch (error) {
      console.error('Erro ao carregar categoria:', error);
      alert('Erro ao carregar categoria.');
    }
  }
});

// Método para salvar categoria
const salvarCategoria = async () => {
  try {
    if (modoEdicao.value) {
      await axios.put(`/api/categorias/${route.params.id}`, categoria.value);
      alert('Categoria atualizada com sucesso!');
    } else {
      await axios.post('/api/categorias', categoria.value);
      alert('Categoria criada com sucesso!');
    }
    router.push('/categorias'); // Redireciona para a lista de categorias
  } catch (error) {
    console.error('Erro ao salvar categoria:', error);
    alert('Erro ao salvar categoria.');
  }
};
</script>

<style scoped>
.container-fluid {
  padding: 20px;
}

.form-control {
  max-width: 500px;
}

.btn {
  margin-right: 5px;
}
</style>
