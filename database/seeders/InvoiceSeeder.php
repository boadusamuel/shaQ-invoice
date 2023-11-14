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
           $invoice->items()->saveMany(InvoiceItem::factory(5)->make());
       }

    }
}
