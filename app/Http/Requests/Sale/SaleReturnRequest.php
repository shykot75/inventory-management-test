<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class SaleReturnRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer',
            'sale_id' => 'required|integer',
            'return_date' => 'required|date',
            'return_quantity' => 'required|integer',
            'return_amount' => 'required',
            'payment_type' => 'nullable',
            'payment_status' => 'required',
            'return_reason' => 'nullable',
        ];

    }


    public function messages()
    {
        return [
            'product_id.required' => 'Select a Product',
            'supplier_id.required' => 'Select a Supplier',
            'sale_date.required' => 'Select a Date',
            'sale_quantity.required' => 'Enter Quantity',
            'sale_total.required' => 'Enter Total Price',
            'payment_status.required' => 'Select a Payment Status',


        ];
    }

    public function authorize()
    {
        return true;
    }
}
