<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::factory(10)->create();

        foreach ($invoices as $invoice) {

            $quantity = fake()->numberBetween(1, 5);
            $amount = fake()->numberBetween(1, 5);
            $description = fake()->text();
            $itemId = fake()->numberBetween(1, 5);
            $unitPrice = fake()->numberBetween(1, 5);


            $invoice->items()->attach(
                $itemId,
            [
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'amount' => $amount,
                'description' => $description,
            ]);

            $invoice->total = $invoice->items()->sum('amount');

            $invoice->save();
        }
    }
}
