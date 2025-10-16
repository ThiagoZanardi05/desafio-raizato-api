# API de Lista de Tarefas (To-Do List) - Desafio de Programação

Esta é a API RESTful desenvolvida como back-end para o desafio de programação. A API foi construída com **Laravel**, seguindo as melhores práticas de desenvolvimento para gerenciar recursos de uma aplicação de lista de tarefas.

## Sobre o Projeto

O objetivo deste projeto é fornecer um back-end robusto e bem estruturado para uma aplicação de "To-Do List". A API gerencia a criação, leitura, atualização e exclusão de tarefas, oferecendo um conjunto completo de endpoints para interagir com os dados.

## Tecnologias e Conceitos Utilizados

- **Framework:** Laravel 11
- **Linguagem:** PHP 8.3
- **Banco de Dados:** SQLite (para simplicidade e portabilidade)
- **Arquitetura:** RESTful
- **Principais Recursos do Laravel Utilizados:**
  - **Eloquent ORM:** Para uma interação elegante e segura com o banco de dados.
  - **API Resources:** Utilização de `Route::apiResource` para a criação automática de rotas RESTful.
  - **Migrations:** Para o versionamento e gerenciamento da estrutura do banco de dados.
  - **Validação de Requests:** Integrada diretamente nos controllers para garantir a integridade dos dados de entrada.
  - **Route Model Binding:** Para injetar modelos de forma limpa e automática nas rotas.

## Endpoints da API

A base de todos os endpoints é `/api`.

| Verbo HTTP | URI             | Ação                                     |
|------------|-----------------|------------------------------------------|
| `GET`      | `/tasks`        | Lista todas as tarefas.                  |
| `POST`     | `/tasks`        | Cria uma nova tarefa.                    |
| `GET`      | `/tasks/{task}` | Exibe os detalhes de uma tarefa específica. |
| `PUT/PATCH`| `/tasks/{task}` | Atualiza uma tarefa existente.           |
| `DELETE`   | `/tasks/{task}` | Apaga uma tarefa.                        |

### Exemplo de Payload para Criação (POST /tasks)

```json
{
    "title": "Minha Nova Tarefa",
    "description": "Descrição opcional da tarefa."
}
```

### Exemplo de Payload para Atualização (PUT /tasks/{id})

```json
{
    "title": "Título Atualizado",
    "description": "Descrição atualizada.",
    "status": "concluída"
}
```

## Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e rodar a API em seu ambiente de desenvolvimento.

### Pré-requisitos

- PHP >= 8.2
- Composer
- Um ambiente de desenvolvimento local como Laragon (recomendado), XAMPP ou WAMP.

### Passos para Instalação

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/seu-repositorio-api.git](https://github.com/seu-usuario/seu-repositorio-api.git)
    cd seu-repositorio-api
    ```

2.  **Instale as dependências do Composer:**
    ```bash
    composer install
    ```

3.  **Configure o arquivo de ambiente:**
    - Copie o arquivo `.env.example` para um novo arquivo chamado `.env`.
    ```bash
    cp .env.example .env
    ```
    - O projeto já está pré-configurado para usar SQLite, então nenhuma alteração adicional no `.env` é necessária.

4.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

5.  **Crie o arquivo do banco de dados SQLite:**
    ```bash
    touch database/database.sqlite
    ```

6.  **Execute as migrations para criar as tabelas no banco de dados:**
    ```bash
    php artisan migrate
    ```

7.  **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

A API estará disponível em `http://127.0.0.1:8000`.

---
*Este projeto foi desenvolvido como parte de um desafio de programação.*
