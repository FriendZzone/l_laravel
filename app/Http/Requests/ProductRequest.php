<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product-name' => 'required|min:6',
            'product-price' => 'required|integer',
        ];
    }

    // Validation rules
    public function messages()
    {
        return [
            'product-name.required' => 'This :attribute is required',
            'body.required' => 'A message is required',
            'integer' => 'This :attribute must be a number',
            'min' => ':attribute must be :min characters'
        ];
    }

    public function attributes()
    {
        return [
            'product-name' => 'Tên sản phẩm',
            'product-price' => 'Giá sản phẩm',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'created_at' => new \DateTime
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', 'Something is wrong with this field!');
            }
        });
    }

    protected function failedAuthorization()
    {
        return '<h3>You not have permission</h3>';
    }
}
