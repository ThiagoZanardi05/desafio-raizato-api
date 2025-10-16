<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se a rota para listar todas as tarefas está funcionando.
     */
    public function test_can_list_all_tasks(): void
    {
        // Cria 3 tarefas no banco de dados de teste
        Task::factory()->count(3)->create();

        // Faz uma requisição GET para a API
        $response = $this->getJson('/api/tasks');

        // Verifica se a resposta foi bem-sucedida (status 200)
        $response->assertStatus(200);

        // Verifica se a resposta contém exatamente 3 tarefas
        $response->assertJsonCount(3);
    }

    /**
     * Testa a criação de uma nova tarefa.
     */
    public function test_can_create_a_new_task(): void
    {
        // Dados da nova tarefa
        $taskData = [
            'title' => 'Minha Nova Tarefa de Teste',
            'description' => 'Descrição da tarefa.',
        ];

        // Faz uma requisição POST para a API
        $response = $this->postJson('/api/tasks', $taskData);

        // Verifica se a tarefa foi criada com sucesso (status 201)
        $response->assertStatus(201);

        // Verifica se a resposta contém o título da tarefa criada
        $response->assertJsonFragment(['title' => 'Minha Nova Tarefa de Teste']);

        // Verifica se a tarefa foi realmente salva no banco de dados
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /**
     * Testa a exibição de uma tarefa específica.
     */
    public function test_can_show_a_specific_task(): void
    {
        // Cria uma tarefa
        $task = Task::factory()->create();

        // Faz uma requisição GET para o endpoint da tarefa específica
        $response = $this->getJson("/api/tasks/{$task->id}");

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(200);

        // Verifica se a resposta contém o título da tarefa
        $response->assertJsonFragment(['title' => $task->title]);
    }

    /**
     * Testa a atualização de uma tarefa.
     */
    public function test_can_update_a_task(): void
    {
        // Cria uma tarefa
        $task = Task::factory()->create();

        // Novos dados para a tarefa
        $updatedData = [
            'title' => 'Título Atualizado',
            'status' => 'concluída',
        ];

        // Faz uma requisição PUT para atualizar a tarefa
        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(200);

        // Verifica se a resposta contém os dados atualizados
        $response->assertJsonFragment($updatedData);

        // Verifica se o banco de dados foi atualizado
        $this->assertDatabaseHas('tasks', $updatedData);
    }

    /**
     * Testa a exclusão de uma tarefa.
     */
    public function test_can_delete_a_task(): void
    {
        // Cria uma tarefa
        $task = Task::factory()->create();

        // Faz uma requisição DELETE para apagar a tarefa
        $response = $this->deleteJson("/api/tasks/{$task->id}");

        // Verifica se a resposta foi "No Content" (status 204), indicando sucesso
        $response->assertStatus(204);

        // Verifica se a tarefa foi removida do banco de dados
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Testa se a criação de uma tarefa falha se o título não for enviado.
     */
    public function test_creation_fails_if_title_is_missing(): void
    {
        $taskData = [
            'description' => 'Tarefa sem título.',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        // Verifica se a resposta é "Unprocessable Content" (erro de validação)
        $response->assertStatus(422);

        // Verifica se a resposta JSON contém um erro para o campo "title"
        $response->assertJsonValidationErrors('title');
    }

    /**
     * Testa se a atualização falha se o status for inválido.
     */
    public function test_update_fails_if_status_is_invalid(): void
    {
        $task = Task::factory()->create();

        $updatedData = [
            'status' => 'qualquer_coisa', // um status inválido
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);

        // Verifica se a resposta é um erro de validação
        $response->assertStatus(422);

        // Verifica se a resposta JSON contém um erro para o campo "status"
        $response->assertJsonValidationErrors('status');
    }
}