<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => Book::inRandomOrder()->first()->id,
            'text' => $this->faker->paragraph(),
            'where' => $this->faker->text(100),
            'when' => $this->faker->text(100)
        ];
    }
}
