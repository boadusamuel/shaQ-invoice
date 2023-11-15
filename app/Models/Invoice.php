<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'customer_id',
        'issue_date',
        'due_date',
        'total'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'invoice_items')
            ->withPivot(['id', 'unit_price', 'quantity', 'amount', 'description']);
    }

    public function generateCode(): string
    {
        $lastInvoice = self::orderBy('id', 'desc')->first();

        $nextInvoiceNumber = $lastInvoice ? ($lastInvoice->id + 1) : 1;

        return 'INV' . str_pad($nextInvoiceNumber, 5, '0', STR_PAD_LEFT);
    }
}
