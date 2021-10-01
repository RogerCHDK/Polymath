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
            'nombre' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'logotipo' => $this->faker->image(null, 640, 480),
            'sitio_web' => $this->faker->url(), 
            // 'destinatario' => $this->faker->name(),
        ];
    }
}
