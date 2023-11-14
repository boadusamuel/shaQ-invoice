<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => $this->faker->numberBetween(1, 5),
            'item_id' => $this->faker->numberBetween(1, 5),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->numberBetween(1, 5),
            'amount' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->text(),
        ];
    }
}
