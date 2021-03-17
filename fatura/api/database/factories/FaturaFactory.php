<?php

namespace Database\Factories;

use App\Models\Fatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaturaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fatura::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cpf' => $this->faker->word,
        'dataVencimento' => $this->faker->word,
        'dataLeitura' => $this->faker->word,
        'valorLeitura' => $this->faker->word,
        'valorConta' => $this->faker->word,
        'idEndereco' => $this->faker->randomDigitNotNull
        ];
    }
}
