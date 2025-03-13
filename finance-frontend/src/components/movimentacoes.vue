<template>
  <div class="container-fluid">
    <!-- Resumo Financeiro -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card bg-light">
          <div class="card-body">
            <h5 class="card-title">Saldo Total</h5>
            <p class="card-text fs-4">{{ formatarValor(saldoTotal) }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-light">
          <div class="card-body">
            <h5 class="card-title">Total Receitas</h5>
            <p class="card-text fs-4 text-success">{{ formatarValor(totalReceitas) }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-light">
          <div class="card-body">
            <h5 class="card-title">Total Despesas</h5>
            <p class="card-text fs-4 text-danger">{{ formatarValor(totalDespesas) }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filtros e Botão de Adicionar -->
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="btn-group">
          <button
            class="btn"
            :class="{
              'btn-primary': filtroTipo === 'todos',
              'btn-outline-primary': filtroTipo !== 'todos',
            }"
            @click="filtroTipo = 'todos'"
          >
            Todos
          </button>
          <button
            class="btn"
            :class="{
              'btn-success': filtroTipo === 'receita',
              'btn-outline-success': filtroTipo !== 'receita',
            }"
            @click="filtroTipo = 'receita'"
          >
            Receitas
          </button>
          <button
            class="btn"
            :class="{
              'btn-danger': filtroTipo === 'despesa',
              'btn-outline-danger': filtroTipo !== 'despesa',
            }"
            @click="filtroTipo = 'despesa'"
          >
            Despesas
          </button>
        </div>
      </div>
      <div class="col-md-4 text-end">
        <router-link to="/movimentacoes/nova" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Nova Movimentação
        </router-link>
      </div>
    </div>

    <!-- Tabela de Movimentações -->
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col" @click="ordenarPor('descricao')">
            Descrição <i class="bi bi-arrow-down-up"></i>
          </th>
          <th scope="col" @click="ordenarPor('valor')">
            Valor <i class="bi bi-arrow-down-up"></i>
          </th>
          <th scope="col" @click="ordenarPor('data')">Data <i class="bi bi-arrow-down-up"></i></th>
          <th scope="col">Tipo</th>
          <th scope="col">Categoria</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(movimentacao, index) in movimentacoesFiltradas" :key="index">
          <td>{{ movimentacao.descricao }}</td>
          <td
            :class="{
              'text-success': movimentacao.tipo_id === 1,
              'text-danger': movimentacao.tipo_id === 2,
            }"
          >
            {{ formatarValor(movimentacao.valor) }}
          </td>
          <td>{{ formatarData(movimentacao.data) }}</td>
          <td>
            <span
              :class="{
                'badge bg-success': movimentacao.tipo_id === 1,
                'badge bg-danger': movimentacao.tipo_id === 2,
              }"
            >
              {{ movimentacao.tipo_id === 1 ? 'Receita' : 'Despesa' }}
            </span>
          </td>
          <td>{{ movimentacao.categoria?.nome }}</td>
          <td>
            <button class="btn btn-sm btn-primary me-2" @click="abrirModalEditar(movimentacao)">
              <i class="bi bi-pencil"></i> Editar
            </button>
            <button class="btn btn-sm btn-danger" @click="excluirMovimentacao(movimentacao.id)">
              <i class="bi bi-trash"></i> Excluir
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

 <!-- Modal de Edição -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Movimentação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="salvarEdicao">
          <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" v-model="movimentacaoEditavel.descricao" required />
          </div>
          <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" v-model="movimentacaoEditavel.valor" required />
          </div>
          <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data" v-model="movimentacaoEditavel.data" required />
          </div>
          <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-select" id="categoria_id" v-model="movimentacaoEditavel.categoria_id" required>
              <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                {{ categoria.nome }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tipo_id" class="form-label">Tipo</label>
            <select class="form-select" id="tipo_id" v-model="movimentacaoEditavel.tipo_id" required>
              <option value="1">Receita</option>
              <option value="2">Despesa</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { Modal } from 'bootstrap';

const movimentacoes = ref([]);
const filtroTipo = ref('todos');
const ordenacao = ref({ campo: 'data', ordem: 'asc' });
const modalEditar = ref(null);
const movimentacaoEditavel = ref({});
const categorias = ref([]);

const formatarValor = (valor) => {
  return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
};

const formatarData = (data) => {
  const date = data instanceof Date ? data : new Date(data);
  return date.toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  });
};

const abrirModalEditar = (movimentacao) => {
  movimentacaoEditavel.value = { ...movimentacao };
  if (!modalEditar.value) {
    modalEditar.value = new Modal(document.getElementById('modalEditar'));
  }
  modalEditar.value.show();
};

const salvarEdicao = async () => {
  try {
    await axios.put(`/api/movimentacoes/${movimentacaoEditavel.value.id}`, movimentacaoEditavel.value);
    const index = movimentacoes.value.findIndex((m) => m.id === movimentacaoEditavel.value.id);
    if (index !== -1) {
      movimentacoes.value[index] = movimentacaoEditavel.value;
    }
    modalEditar.value.hide();
    alert('Movimentação atualizada com sucesso!');
  } catch (error) {
    console.error('Erro ao atualizar movimentação:', error);
    alert('Erro ao atualizar movimentação.');
  }
};

const excluirMovimentacao = async (id) => {
  if (confirm('Tem certeza que deseja excluir esta movimentação?')) {
    try {
      await axios.delete(`/api/movimentacoes/${id}`);
      movimentacoes.value = movimentacoes.value.filter((m) => m.id !== id);
      alert('Movimentação excluída com sucesso!');
    } catch (error) {
      console.error('Erro ao excluir movimentação:', error);
      alert('Erro ao excluir movimentação.');
    }
  }
};

const movimentacoesFiltradas = computed(() => {
  let filtradas = movimentacoes.value;

  if (filtroTipo.value !== 'todos') {
    filtradas = filtradas.filter((m) => m.tipo === filtroTipo.value);
  }

  return filtradas.sort((a, b) => {
    if (ordenacao.value.ordem === 'asc') {
      return a[ordenacao.value.campo] > b[ordenacao.value.campo] ? 1 : -1;
    } else {
      return a[ordenacao.value.campo] < b[ordenacao.value.campo] ? 1 : -1;
    }
  });
});

const saldoTotal = computed(() => {
  return totalReceitas.value - totalDespesas.value;
});

const totalReceitas = computed(() => {
  return movimentacoes.value
    .filter((m) => m.tipo_id === 1)
    .reduce((total, m) => total + Number(m.valor), 0);
});

const totalDespesas = computed(() => {
  return movimentacoes.value
    .filter((m) => m.tipo_id === 2)
    .reduce((total, m) => total + Math.abs(Number(m.valor)), 0);
});

// Método para ordenar
const ordenarPor = (campo) => {
  if (ordenacao.value.campo === campo) {
    ordenacao.value.ordem = ordenacao.value.ordem === 'asc' ? 'desc' : 'asc';
  } else {
    ordenacao.value.campo = campo;
    ordenacao.value.ordem = 'asc';
  }
};

onMounted(async () => {
  try {
    const params = {
      tipo: filtroTipo.value !== 'todos' ? filtroTipo.value : undefined,
      campo: ordenacao.value.campo,
      ordem: ordenacao.value.ordem,
    };
    const response = await axios.get('/api/movimentacoes', { params });
    movimentacoes.value = response.data;
    console.log('Dados retornados:', movimentacoes.value);

    const categoriasResponse = await axios.get('/api/categorias');
    categorias.value = categoriasResponse.data;
  } catch (error) {
    console.error('Erro ao carregar movimentações:', error);
  }
});
</script>

<style scoped>
.container-fluid {
  padding: 20px;
}

.card {
  border: none;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table {
  margin-top: 20px;
}

.badge {
  font-size: 0.9em;
  padding: 0.5em 0.75em;
}

.text-success {
  color: #28a745 !important;
}

.text-danger {
  color: #dc3545 !important;
}

.btn-group .btn {
  margin-right: 5px;
}
</style>
