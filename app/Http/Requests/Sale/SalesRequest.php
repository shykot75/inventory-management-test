<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'sale_date' => 'required|date',
            'sale_quantity' => 'required|integer',
            'sale_total' => 'required',
            'payment_type' => 'nullable',
            'payment_status' => 'required',
            'is_returned' => 'nullable',
        ];

    }


    public function messages()
    {
        return [
            'product_id.required' => 'Select a Product',
            'customer_id.required' => 'Select a Customer',
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
