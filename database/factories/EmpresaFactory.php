<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empresa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => "All4Streaming",
            'direccion' => "Newcastle upon Tyne, Reino Unido",
            'email' => "atencionalcliente@all4streaming.com",
            'telefono' => "+44 7809-309-205",
            'web' => "www.all4streaming.com",
        ];
    }
}
