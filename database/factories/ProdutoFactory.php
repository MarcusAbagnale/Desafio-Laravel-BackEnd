<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'descricao' => $this->faker->sentence,
            'preco' => $this->faker->randomFloat(2, 0, 100),
            'data_validade' => $this->faker->date(),
            'categoria_id' => 1, 
            'imagem' => $this->faker->image('public/fotos', 640, 480, null, false),
        ];
    }
}
