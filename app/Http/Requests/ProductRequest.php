<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|',
            'image' => 'required|',
            'price' => 'required|numeric',
            // 'description' => 'required',
            // 'brand' => 'required',
            'quantity' => 'required|numeric',
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
      

        ];
    }
}
