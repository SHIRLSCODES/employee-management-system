<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StockItem;
use Illuminate\Validation\Rule;

class SaveStockRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stock_item_id' => [
                'required',
                'exists:stock_items,id',
                function ($attribute, $value, $fail) {
                    $stockItem = StockItem::find($value);
                    if ($stockItem && $stockItem->quantity <= 0) {
                        $fail('The selected stock item is out of stock.');
                    }
                },
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($this->stock_item_id) {
                        $stockItem = StockItem::find($this->stock_item_id);
                        if ($stockItem && $value > $stockItem->quantity) {
                            $fail('Requested quantity (' . $value . ') exceeds available stock (' . $stockItem->quantity . ' ' . $stockItem->unit . ' available).');
                        }
                    }
                },
            ],
            'note' => 'nullable|string|max:1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'stock_item_id' => 'stock item',
            'quantity' => 'quantity',
            'note' => 'note',
        ];
    }

    public function messages(): array
    {
        return [
            'stock_item_id.required' => 'Please select a stock item.',
            'stock_item_id.exists' => 'The selected stock item does not exist.',
            'quantity.required' => 'Please enter the quantity needed.',
            'quantity.integer' => 'Quantity must be a valid number.',
            'quantity.min' => 'Quantity must be at least 1.',
            'note.max' => 'Note cannot exceed 1000 characters.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->stock_item_id && $this->quantity) {
                $stockItem = StockItem::find($this->stock_item_id);
                
                if ($stockItem) {
                    if ($stockItem->quantity <= 0) {
                        $validator->errors()->add('stock_item_id', 'The selected stock item is currently out of stock.');
                    }
    
                    if ($this->quantity > $stockItem->quantity) {
                        $validator->errors()->add('quantity', 
                            'Cannot request ' . $this->quantity . ' ' . $stockItem->unit . 
                            '. Only ' . $stockItem->quantity . ' ' . $stockItem->unit . ' available in stock.'
                        );
                    }
                }
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'quantity' => (int) $this->quantity,
            'note' => $this->note ? trim($this->note) : null,
        ]);
    }

}
