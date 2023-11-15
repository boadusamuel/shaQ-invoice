<?php

namespace App\Http\Requests;

use App\Rules\InvoiceItemsUpdateSufficientStockRule;
use App\Rules\SufficientStockRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'items.*.itemId' => ['required','integer', 'exists:items,id'],
            'items.*.quantity' => ['required','integer', 'min:1'],
            'items.*.description' => ['required','string'],
            'items.*.price' => ['required','numeric'],
            'items' => ['required','array', 'min:1', new InvoiceItemsUpdateSufficientStockRule()],
        ];
    }
}
