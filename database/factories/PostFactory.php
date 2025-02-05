<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Va a generar datos de prueba para la base de datos
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->paragraph(2),
            'imagen' => $this->faker->uuid() . '.jpg',
            // no deberia insertar id no existentes, por eso pongo existentes y no
            'user_id' => $this->faker->randomElement([1, 3, 6, 7]),
        ];
    }
}
