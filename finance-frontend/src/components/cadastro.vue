<template>
  <div class="login-container">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; margin-top: 10vh">
      <h2 class="card-title text-center mb-4">Cadastro</h2>
      <form @submit.prevent="register">
        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input
            v-model="name"
            type="text"
            id="name"
            class="form-control"
            placeholder="Digite seu nome completo"
            required
          />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            v-model="email"
            type="email"
            id="email"
            class="form-control"
            placeholder="Digite seu email"
            required
          />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input
            v-model="password"
            type="password"
            id="password"
            class="form-control"
            placeholder="Digite sua senha"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const name = ref('')
const email = ref('')
const password = ref('')

const register = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/register', {
      name: name.value,
      email: email.value,
      password: password.value,
    })

    console.log('Cadastro bem-sucedido:', response.data)

    window.location.href = '/login'
  } catch (error) {
    console.error('Erro ao cadastrar:', error.response ? error.response.data : error)
  }
}
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f7fc;
  animation: fadeIn 1s ease-in-out;
}

.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  animation: slideInUp 0.5s ease-in-out;
}

.form-label {
  font-weight: 600;
}

.btn-primary {
  background-color: #0056b3;
  border: 1px solid #0056b3;
  transition:
    background-color 0.3s ease,
    transform 0.3s ease;
}

.btn-primary:hover {
  background-color: #004085;
  transform: scale(1.05);
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes slideInUp {
  0% {
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
</style>
