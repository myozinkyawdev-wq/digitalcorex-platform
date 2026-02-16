<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function vpn(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'VPN & Privacy',
            'slug' => 'vpn-privacy',
            'order' => 1,
        ]);
    }
    
    public function streaming(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'Streaming',
            'slug' => 'streaming',
            'order' => 2,
        ]);
    }
    
    public function socialMedia(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'Social Media',
            'slug' => 'social-premium',
            'order' => 3,
        ]);
    }
}
