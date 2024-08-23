<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        $productId = $this->route('productId');
        $rules = [
            'product_name' => 'required|max:255',
            'category_id' => 'required|integer',
            'sku' => 'required|unique:products,sku',
            'product_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'product_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'product_description' => 'nullable',
            'status' => 'required'
        ];
        // Modify the rules for updating data
        if ($productId) {
            $rules['sku'] .= ",{$productId},product_id"; // Use 'product_id' as the primary key column
        }

        return $rules;

    }


    public function messages()
    {
        return [
            'product_name.required' => 'Product Name is required',
            'product_name.max' => 'Product Name not more than 255 characters long',

            'category_id.required' => 'Select a Category',

            'sku.required' => 'SKU is required',
            'sku.unique' => 'SKU should be unique',

            'product_price.required' => 'Product Price is required',
            'quantity.required' => 'Product Quantity is required',


        ];
    }

    public function authorize()
    {
        return true;
    }
}
