<template>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
      <!-- Container wrapper -->
      <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="#">
          <h2><i class="bi bi-bar-chart-fill"></i></h2>
        </a>

        <!-- Toggle button -->
        <button
          data-mdb-collapse-init
          class="navbar-toggler"
          type="button"
          data-mdb-target="#navbarButtonsExample"
          aria-controls="navbarButtonsExample"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Dashboard</a>
            </li>
          </ul>
          <!-- Left links -->

          <div class="d-flex align-items-center">
            <button
              class="btn btn-dark"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasNav"
              aria-controls="offcanvasNav"
            >
              <i class="bi bi-list"></i> Menu
            </button>
          </div>
        </div>
      </div>
    </nav>

    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasNav"
      aria-labelledby="offcanvasNavLabel"
    >
      <div class="offcanvas-header justify-content-center">
        <h5 class="offcanvas-title" id="offcanvasNavLabel">Controle Financeiro</h5>
      </div>
      <div class="offcanvas-body text-center">
        <ul class="list-unstyled">
          <li><a href="#" class="btn btn-link">Dashboard</a></li>

          <!-- Movimentações Dropdown -->
          <li class="nav-item dropdown">
            <a
              class="btn btn-link dropdown-toggle"
              href="#"
              id="movimentacoesDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Movimentações
            </a>
            <ul class="dropdown-menu" aria-labelledby="movimentacoesDropdown">
              <router-link class="dropdown-item" to="/movimentacoes">Ver Todos</router-link>
              <router-link class="dropdown-item" to="/movimentacoes/nova">Criar Nova</router-link>
            </ul>
          </li>

          <!-- Categorias Dropdown -->
          <li class="nav-item dropdown">
            <a
              class="btn btn-link dropdown-toggle"
              href="#"
              id="categoriasDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Categorias
            </a>
            <ul class="dropdown-menu" aria-labelledby="categoriasDropdown">
              <router-link class="dropdown-item" to="/categorias">Ver Todos</router-link>
              <router-link class="dropdown-item" to="/categorias/nova">Criar Nova</router-link>
             </ul>
          </li>
        </ul>
      </div>
    </div>

    <!-- Cards de informações -->
    <div class="row mt-4">
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card bg-primary text-white animate__animated animate__fadeInUp zoom-card">
          <div class="card-body">
            <h5 class="card-title">Saldo Total</h5>
            <p class="card-text">R$ 15.230,50</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card bg-success text-white animate__animated animate__fadeInUp zoom-card">
          <div class="card-body">
            <h5 class="card-title">Receitas</h5>
            <p class="card-text">R$ 12.000,00</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card bg-warning text-white animate__animated animate__fadeInUp zoom-card">
          <div class="card-body">
            <h5 class="card-title">Despesas</h5>
            <p class="card-text">R$ 4.500,00</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de movimentações financeiras -->
    <table class="table table-striped mt-4 animate__animated animate__fadeInUp">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Descrição</th>
          <th scope="col">Valor</th>
          <th scope="col">Data</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Recebimento Cliente A</td>
          <td>R$ 3.500,00</td>
          <td>10/03/2025</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Compra fornecedor B</td>
          <td>-R$ 1.200,00</td>
          <td>09/03/2025</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Pagamento Funcionário</td>
          <td>-R$ 2.000,00</td>
          <td>08/03/2025</td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Venda Produto X</td>
          <td>R$ 4.800,00</td>
          <td>07/03/2025</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Rodapé -->
  <footer class="bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05)">
      © 2025 Copyright:
      <a class="text-body" href="#">Tarcísio Kayck</a>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted } from 'vue'
</script>

<style scoped>
.container-fluid {
  padding-left: 30px;
  padding-right: 30px;
}

.navbar {
  margin-bottom: 30px;
}

.card {
  border-radius: 10px;
  transition: transform 0.3s ease-in-out;
}

.card-body {
  text-align: center;
}

footer {
  position: absolute;
  width: 100%;
  bottom: 0;
}

.table {
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}

/* Offcanvas */
.offcanvas-header {
  justify-content: center;
}

.offcanvas-body a {
  display: block;
  margin-bottom: 15px;
  font-size: 18px;
  color: #000;
  text-decoration: none;
}

.offcanvas-body a:hover {
  color: #007bff;
  text-decoration: underline;
}

/* Animações */
.animate__fadeInUp {
  animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Efeito de zoom nos cards */
.zoom-card:hover {
  transform: scale(1.05);
}
</style>
