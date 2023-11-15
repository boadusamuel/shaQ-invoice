<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'itemName' => $this->item,
            'unitPrice' => formatNumber($this->unit_price),
            'quantity' => $this->quantity,
            'amount' => formatNumber($this->amount ),
            'description' => $this->description,
        ];
    }
}
