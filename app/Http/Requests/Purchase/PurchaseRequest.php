<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'purchase_date' => 'required|date',
            'purchase_quantity' => 'required|integer',
            'purchase_total' => 'required',
            'payment_type' => 'nullable',
            'payment_status' => 'required',
            'is_returned' => 'nullable',
        ];

    }


    public function messages()
    {
        return [
            'product_id.required' => 'Select a Product',
            'supplier_id.required' => 'Select a Supplier',
            'purchase_date.required' => 'Select a Date',
            'purchase_quantity.required' => 'Enter Quantity',
            'purchase_total.required' => 'Enter Total Price',
            'payment_status.required' => 'Select a Payment Status',


        ];
    }

    public function authorize()
    {
        return true;
    }
}
