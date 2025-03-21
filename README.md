# Finance-desafio
# Projeto de Gerenciamento Financeiro

Este projeto foi desenvolvido como parte de um desafio técnico. Ele consiste em um sistema de gerenciamento financeiro que permite cadastrar, editar, excluir e visualizar movimentações financeiras (receitas e despesas) e categorias.

## Funcionalidades

- **Movimentações Financeiras**:
  - Cadastrar novas movimentações (receitas e despesas).
  - Editar movimentações existentes.
  - Excluir movimentações.
  - Visualizar todas as movimentações em uma tabela.
  - Filtrar movimentações por tipo (receita ou despesa).
  - Ordenar movimentações por descrição, valor ou data.
  - Exibir saldo total, total de receitas e total de despesas.

- **Categorias**:
  - Cadastrar novas categorias.
  - Editar categorias existentes.
  - Excluir categorias.
  - Visualizar todas as categorias em uma tabela.

## Tecnologias Utilizadas

- **Frontend**:
  - Vue.js 3
  - Bootstrap 5
  - Axios (para requisições HTTP)

- **Backend**:
  - Laravel 10
  - MySQL (banco de dados)

## Como Rodar o Projeto

### Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- [PHP](https://www.php.net/) (versão 8.1 ou superior)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (versão 16 ou superior)
- [MySQL](https://www.mysql.com/) ou outro banco de dados compatível com Laravel

### Passo a Passo

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/kayck10/Finance-desafio-.git
   cd nome-do-repositorio
Configure o backend:

Crie um arquivo .env na raiz do projeto (copie o .env.example):

bash
Copy
cp .env.example .env
Configure as variáveis de ambiente no arquivo .env (banco de dados, chave de aplicação, etc.):

env
Copy
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
Instale as dependências do Laravel:

bash
Copy
composer install
Gere a chave da aplicação:

bash
Copy
php artisan key:generate
Execute as migrações para criar as tabelas no banco de dados:

bash
Copy
php artisan migrate
(Opcional) Popule o banco de dados com dados de teste:

bash
Copy
php artisan db:seed
Inicie o servidor Laravel:

bash
Copy
php artisan serve
Configure o frontend:

Navegue até a pasta do frontend:

bash
Copy
cd frontend
Instale as dependências do Vue.js:

bash
Copy
npm install
Configure o arquivo .env do frontend (se necessário):

env
Copy
VITE_API_URL=http://localhost:8000/api
Inicie o servidor de desenvolvimento do Vue.js:

bash
Copy
npm run dev
Acesse o projeto:

Abra o navegador e acesse:

Copy
http://localhost:5173
