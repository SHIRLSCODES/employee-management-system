<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveStockReturnRequest extends FormRequest
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
            'stock_item_id' => ['required', 'exists:stock_items,id'],
            'condition' => ['required', 'in:good,damaged,unused'],
            'remarks' => ['nullable', 'string', 'max:1000'],
            'quantity' => ['required', 'integer', 'min:1'],
            'stock_requisition_id' => ['nullable', 'exists:stock_requisitions,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'stock_item_id' => 'stock item',
            'condition' => 'condition',
            'remarks' => 'remarks',
            'stock_requisition_id' => 'stock requisition',
            'quantity' => 'quantity',
        ];
    }

    public function messages(): array
    {
        return [
            'stock_item_id.required' => 'Please select a stock item.',
            'stock_item_id.exists' => 'The selected stock item does not exist.',
            
            'condition.required' => 'Please select the condition of the item.',
            'condition.in' => 'Condition must be one of: good, damaged, or unused.',

            'quantity.required' => 'Please enter the quantity being returned.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'At least 1 item must be returned.',

            'remarks.max' => 'Remarks cannot exceed 1000 characters.',

            'stock_requisition_id.exists' => 'The selected stock requisition is invalid.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $item = \App\Models\StockItem::find($this->stock_item_id);
            if ($item && !$item->is_returnable) {
                $validator->errors()->add('stock_item_id', 'This stock item is not returnable.');
            }
        });
    }
}
