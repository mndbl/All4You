<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nic' => $this->faker->unique()->buildingNumber,
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'canal' => $this->faker->company,
            'pais' => $this->faker->country,
            'representante' => $this->faker->name,
        ];
    }
}
