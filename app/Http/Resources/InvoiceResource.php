<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoiceNumber' => $this->number,
            'total' => number_format($this->total, 2),
            'customer' => $this->whenLoaded('customer', new CustomerResource($this->customer)),
            'items' => $this->whenLoaded('items', function (){
                return $this->items->map(function ($item){
                       return [
                           'id' => $item->pivot->id,
                           'itemName' => $item->name,
                           'unitPrice' => number_format($item->pivot->unit_price, 2),
                           'quantity' => $item->pivot->quantity,
                           'amount' => number_format($item->pivot->amount, 2),
                           'description' => $item->pivot->description,
                       ];
                   });
            }),
            'issueDate' => Carbon::parse($this->issue_date)->toDateString(),
            'dueDate' => Carbon::parse($this->due_date)->toDateString(),
            'createdAt' => $this->created_at->toDateTimeString(),
        ];
    }
}
