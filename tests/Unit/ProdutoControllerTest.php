<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Produto;
use App\Models\User;
use App\Models\Categoria; // Certifique-se de importar o modelo Categoria
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProdutoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdate()
    {
        // Crie um usuário para autenticação
        $user = User::factory()->create();

        // Crie uma categoria para o produto
        $categoria = Categoria::factory()->create();

        // Crie um produto para testar
        $produto = Produto::factory()->create(['categoria_id' => $categoria->id]);

        // Dados para atualizar o produto
        $data = [
            'nome' => 'Novo nome',
            'descricao' => 'Nova descrição',
            'preco' => 123.45,
            'data_validade' => '2023-12-31',
            'categoria_id' => $categoria->id,
            'imagem' => UploadedFile::fake()->image('produto.jpg'),
        ];

        // Faça a requisição de atualização
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$user->createToken('API Token')->plainTextToken,
        ])->put("/api/produtos/{$produto->id}", $data);

        // Verifique se a resposta é 200 OK
        $response->assertStatus(200);

        // Verifique se o produto foi atualizado no banco de dados
        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
            'nome' => 'Novo nome',
            'descricao' => 'Nova descrição',
            // Adicione todos os campos necessários aqui
        ]);
    }
}
