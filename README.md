# API de Lista de Tarefas (To-Do List) - Desafio Back-end

Esta é a API RESTful desenvolvida como back-end para o desafio de programação. A API foi construída com **Laravel 11**, seguindo as melhores práticas para gerir os recursos de uma aplicação de lista de tarefas de forma robusta, escalável e profissional.

### Sobre o Projeto

O objetivo deste projeto é fornecer um back-end completo para uma aplicação de "To-Do List". A API não só gere a criação, leitura, atualização e exclusão de tarefas, mas também implementa funcionalidades avançadas como **paginação, ordenação e filtragem**, garantindo alta performance e uma arquitetura limpa e testada.

### Tecnologias e Arquitetura

  - **Framework:** Laravel 11
  - **Linguagem:** PHP 8.2+
  - **Banco de Dados:** SQLite (para simplicidade e portabilidade)
  - **Testes:** Pest / PHPUnit

#### Principais Conceitos e Recursos do Laravel Utilizados:

  - **Eloquent ORM:** Para uma interação elegante e segura com o banco de dados.
  - **Testes Automatizados:** Cobertura de testes para todos os endpoints, validando cenários de sucesso e de erro.
  - **API Resources:** Para padronizar e controlar as respostas JSON enviadas ao cliente.
  - **Form Requests:** Para encapsular toda a lógica de validação e autorização, mantendo os controllers limpos.
  - **Migrations:** Para o versionamento e gerenciamento da estrutura do banco de dados.
  - **Route Model Binding:** Para injetar modelos de forma limpa e automática nas rotas.

-----

### Endpoints da API

A base de todos os endpoints é `/api`.

| Verbo HTTP | URI             | Ação                                |
| :--------- | :-------------- | :---------------------------------- |
| `GET`      | `/tasks`        | Lista as tarefas (com filtros).     |
| `POST`     | `/tasks`        | Cria uma nova tarefa.               |
| `GET`      | `/tasks/{task}` | Exibe os detalhes de uma tarefa.    |
| `PUT`      | `/tasks/{task}` | Atualiza uma tarefa existente.      |
| `DELETE`   | `/tasks/{task}` | Apaga uma tarefa.                   |

#### Detalhes do Endpoint `GET /tasks`

Este endpoint aceita vários parâmetros na URL (query string) para controlar a listagem.

| Parâmetro  | Descrição                                         | Valores Válidos                                | Padrão         |
| :--------- | :-------------------------------------------------- | :--------------------------------------------- | :------------- |
| `page`     | O número da página a ser retornada.                 | `integer`                                      | `1`            |
| `per_page` | O número de itens por página (máx: 100).            | `integer`                                      | `15`           |
| `status`   | Filtra as tarefas pelo seu status.                  | `pendente`, `concluída`                        | (nenhum)       |
| `sort_by`  | A coluna para ordenação.                            | `title`, `created_at`, `status`                | `created_at`   |
| `sort_dir` | A direção da ordenação.                             | `asc` (ascendente), `desc` (descendente)       | `desc`         |

**Exemplo de uso:** `GET /api/tasks?status=pendente&sort_by=title`

#### Exemplos de Payload (Corpo da Requisição)

**Criação (`POST /tasks`)**

```json
{
    "title": "Minha Nova Tarefa",
    "description": "Descrição opcional da tarefa."
}
```

**Atualização (`PUT /tasks/{id}`)**

```json
{
    "title": "Título Atualizado",
    "description": "Descrição atualizada.",
    "status": "concluída"
}
```

-----

### Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e rodar a API em seu ambiente de desenvolvimento.

**Pré-requisitos:**

  * PHP \>= 8.2
  * Composer
  * Um ambiente de desenvolvimento local como Laragon, XAMPP ou WAMP.

#### Passos para Instalação

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/ThiagoZanardi05/desafio-raizato-api.git
    cd desafio-raizato-api
    ```

2.  **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3.  **Configure o arquivo de ambiente:**

      * Copie o arquivo `.env.example` para um novo arquivo chamado `.env`.

    <!-- end list -->

    ```bash
    cp .env.example .env
    ```

      * O projeto já está pré-configurado para usar SQLite, então nenhuma alteração adicional no `.env` é necessária.

4.  **Gere a chave da aplicação:**

    ```bash
    php artisan key:generate
    ```

5.  **Crie o arquivo do banco de dados SQLite:**

    ```bash
    touch database/database.sqlite
    ```

6.  **Execute as migrations para criar as tabelas:**

    ```bash
    php artisan migrate
    ```

7.  **Inicie o servidor de desenvolvimento:**

    ```bash
    php artisan serve
    ```

A API estará disponível em `http://127.0.0.1:8000`.

### Como Executar os Testes

Para garantir a integridade e o funcionamento da API, execute a suíte de testes:

```bash
php artisan test
```
