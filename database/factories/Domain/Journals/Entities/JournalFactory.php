<?php

namespace Database\Factories\Domain\Journals\Entities;

use App\Domain\Journals\Entities\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Journals\Entities\Journal>
 */
class JournalFactory extends Factory
{
    protected $model = Journal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'date' => now(),
            'body'=> fake()->text
        ];
    }
}
