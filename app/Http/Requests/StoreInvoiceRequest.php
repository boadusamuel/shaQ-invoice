<?php

namespace App\Http\Requests;

use App\Rules\SufficientStockRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'customerId' => ['required', 'exists:customers,id'],
            'issueDate' => ['date', 'nullable'],
            'dueDate' => ['date', 'required', 'after_or_equal:issueDate'],
            'items.*.itemId' => ['required','integer', 'exists:items,id'],
            'items.*.quantity' => ['required','integer', 'min:1'],
            'items.*.description' => ['required','string'],
            'items.*.price' => ['required','numeric'],
            'items' => ['required','array', 'min:1', new SufficientStockRule()],
        ];
    }
}
